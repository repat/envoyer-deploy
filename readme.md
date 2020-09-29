<img src="https://www.justpark.com/media/img/logos/justpark.svg" width="400" alt="Just Park" />

![Downloads](https://img.shields.io/packagist/dt/repat/envoyer-deploy.svg)
![Release](https://img.shields.io/github/release/repat/envoyer-deploy.svg)
![License](https://img.shields.io/github/license/repat/envoyer-deploy.svg)

# Envoyer Deploy Command

Hi there!

Are you looking for a simple way to deploy your [Envoyer.io](http://envoyer.io) project from the command line? So was I, until I found the Envoyer Deploy Command from [JustPark](http://justpark.com)!

> ⚠️ Update May 2020: Forked and updated for Laravel 5.5+, 6 , 7 and 8

With this Artisan command, deploying to Envoyer.io is as simple as 1...2... well... more like this:

    ➜ php artisan envoyer:deploy
    Deployment request successful!

You can even deploy different projects (although, there's a default option)!

    ➜ php artisan envoyer:deploy --project awesomecake
    Deployment request successful!

Shortcuts are awesome!

    ➜ php artisan envoyer:deploy -p awesomecake
    Deployment request successful!

## Installation

First you'll need to install the [Composer package](https://packagist.org/packages/justpark/envoyer-deploy) from Packagist.

Simply add the following to the `"require-dev"` section of your `composer.json` file, and `composer update`.

```json
"repat/envoyer-deploy": "^1.1.1"
```

Or simply execute:

`composer require repat/envoyer-deploy --dev`

If you're on Laravel < 5.5, you'll need to add the `ServiceProvider` for this command to the `providers` array within your `config/app.php` file. Newer versions make use of [Auto-Discovery](https://laravel-news.com/package-auto-discovery).

```php
'providers' => [

    /*
     * Loads of other providers here...
     */

    'JustPark\Deploy\ServiceProviders\EnvoyerServiceProvider',

],
```

Finally, you'll want to copy [this config file](config/envoyer.php) into your config directory. The `default` config key contains handle of the project you want to deploy by default, and should match up to a project in the `projects` config key. The name of the project doesn't matter, since it's only used within the command. You'll want to pair it with the webook deployment key that you'll find under the 'Deployment Hooks' tab of your Envoyer.io project.

```bash
php artisan vendor:publish
```

It's the bit after the `deploy/` here:

> https://envoyer.io/deploy/4aLDdfsfsd4s6fSzeKGNfakekey75R45wOwTQULEDJNrj

Well, now you're good to go! Check the section at the top of this page for usage examples.

Happy deploying!

Love,

JustPark & repat

## Who are you?

[JustPark](http://justpark.com) is a London based startup solving the problem of parking for people all over the world! We've got affordable parking spaces in major cities, and we even allow property owners to earn some extra cash by renting out their extra space for parking.

We're huge fans of Laravel within the company, and we've even got Laravel evangelist, contributor and best-selling author [Dayle Rees](https://twitter.com/daylerees) on the team.

If you're interested in working with us, why not check out our [jobs page](https://www.justpark.com/jobs/).

![Panda](http://i.imgur.com/HkoUPMk.jpg)

---

[repat](https://repat.de) is an independent Laravel developer and consultant and just updated this for Laravel 5.5+, 6 and 7. All credit goes to the guys at JustPark.

## License

Envoyer Deploy Command is licensed under [The MIT License (MIT)](LICENSE).
