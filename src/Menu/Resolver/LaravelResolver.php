<?php

namespace Devitek\Menu\Resolver;

use Devitek\Menu\Items\Link;
use Devitek\Menu\Resolver;
use Route;

class LaravelResolver implements Resolver
{
    /**
     * Get the URL
     *
     * @param $name
     * @param array $params
     * @return string
     */
    public function getUrl($name, array $params = [])
    {
        return route($name, $params);
    }

    /**
     * Check if the item match the current URL
     *
     * @param Link $item
     * @return bool
     */
    public function match(Link $item)
    {
        return Route::currentRouteName() == $item->destination();
    }
}