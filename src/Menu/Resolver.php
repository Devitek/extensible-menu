<?php

namespace Devitek\Menu;

use Devitek\Menu\Items\Link;

interface Resolver
{
    /**
     * Get the URL
     *
     * @param $name
     * @param array $params
     * @return string
     */
    public function getUrl($name, array $params = []);

    /**
     * Check if the item match the current URL
     *
     * @param Link $item
     * @return bool
     */
    public function match(Link $item);
}