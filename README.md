# An extensible library to manage menus

[![Latest Stable Version](https://poser.pugx.org/devitek/devitek/menu/v/stable)](https://packagist.org/packages/devitek/devitek/menu)
[![Total Downloads](https://poser.pugx.org/devitek/devitek/menu/downloads)](https://packagist.org/packages/devitek/devitek/menu)
[![Latest Unstable Version](https://poser.pugx.org/devitek/devitek/menu/v/unstable)](https://packagist.org/packages/devitek/devitek/menu)
[![License](https://poser.pugx.org/devitek/devitek/menu/license)](https://packagist.org/packages/devitek/devitek/menu)


## Installing

Add ```"devitek/menu": "^1.0.0"``` to your **composer.json** by running :

```
composer require devitek/menu
```

And select version : ```0.*```

## How to use

You can use it like this :

```php
<?php

$html = (new Devitek\Menu\Renderer\TwitterBootstrap\Navbar())
    ->translateWith(new Devitek\Menu\Translator\LaravelTranslator())
    ->resolveUrlWith(new Devitek\Menu\Resolver\LaravelResolver())
    ->isFluid()
    ->handleResponsive()
    ->isFixedTop()
    ->withBrand('My super project', '/')
    ->onTheLeft((new Menu())->with([
        (new IconLink('pages.home.link'))->withDestination('home')->withIcon('glyphicon glyphicon-home'),
    ]))
    ->onTheRight((new Menu())->with([
        (new Devitek\Menu\Items\IconGroup('pages.account.link'))->withIcon('glyphicon glyphicon-user')->need([
            function () { return ! Auth::guest(); }
        ]) ->withUnder([
            (new Devitek\Menu\Items\IconLink('pages.administration.utilisateurs.lien'))->withDestination('administration.utilisateurs')->withIcon('glyphicon glyphicon-cog'),
        ]),
    ]))
    ->render();
```

In this case, I use the translator provider and route resolver for laravel.

## What's included

### Items

Base :

* Item

Classes :

* Link
* IconLink
* Group
* IconGroup

Trait :

* WithIcon

### Renderer

Base :

* Renderer

Twitter Bootstrap :

* Navbar

### Resolver

Interface :

* Resolver

Laravel :

* LaravelResolver

### Translator

Interface :

* Translator

Laravel :

* LaravelTranslator

# TODO

* More integrations (Zf2, Symfony2...)
* More doc
* More examples

Enjoy it ! Feel free to fork :) !
