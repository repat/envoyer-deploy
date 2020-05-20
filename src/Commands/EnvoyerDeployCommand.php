<?php

namespace JustPark\Deploy\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Config\Repository as Config;
use InvalidArgumentException;
use Symfony\Component\Console\Input\InputOption;

class EnvoyerDeployCommand extends Command
{
    /**
     * Mask for deployment hook URL.
     */
    const DEPLOY_URL = 'https://envoyer.io/deploy/%s';

    /**
     * Default project configuration key.
     */
    const CONFIG_DEFAULT = 'envoyer.default';

    /**
     * Single project configuration key.
     */
    const CONFIG_PROJECT = 'envoyer.projects.%s';

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'envoyer:deploy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deploy an Envoyer.io project.';

    /**
     * Configuration repository.
     *
     * @var \Illuminate\Contracts\Config\Repository
     */
    protected $config;

    /**
     * Create a new command instance.
     *
     * @param \Illuminate\Contracts\Config\Repository $config
     * @return void
     */
    public function __construct(Config $config)
    {
        // Set configuration repository.
        $this->config = $config;

        parent::__construct();
    }

    /**
     * Shim layer for Laravel < 5.5
     *
     * @return void
     */
    public function fire()
    {
        $this->handle();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        // Get the project to deploy.
        $project = $this->getProjectToDeploy();

        // Trigger the deployment.
        $this->triggerDeploy($project);
    }

    /**
     * Retrieve hook from supplied project option or default.
     *
     * @return string
     */
    protected function getProjectToDeploy()
    {
        // Determine project to deploy.
        if (! $project = $this->option('project')) {
            $project = $this->getDefaultProjectHook();
        }

        return $project;
    }

    /**
     * Retrieve the default project hook.
     *
     * @return string
     */
    protected function getDefaultProjectHook()
    {
        // Get default project handle.
        $default = $this->config->get(self::CONFIG_DEFAULT);

        // Return project hook value.
        return $this->config->get(sprintf(self::CONFIG_PROJECT, $default));
    }

    /**
     * Trigger a deployment by project hook.
     *
     * @param  string $project
     * @return void
     */
    protected function triggerDeploy($project)
    {
        // Ensure we have a project hook.
        if (! $project) {
            throw new InvalidArgumentException('Incorrect project hook.');
        }

        // Trigger the deploy hook.
        file_get_contents(sprintf(self::DEPLOY_URL, $project));

        // Output message.
        $this->info('Deployment request successful!');
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            [
                'project',
                'p',
                InputOption::VALUE_OPTIONAL,
                'The project that will be deployed.',
                false
            ]
        ];
    }
}
