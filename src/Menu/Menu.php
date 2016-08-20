<?php

namespace Devitek\Menu;

use Devitek\Menu\Items\Item;

class Menu
{
    /**
     * @var array
     */
    protected $items = [];

    /**
     * Set items
     *
     * @param array $items
     * @return $this
     */
    public function with(array $items = [])
    {
        $this->items = $items;

        return $this;
    }

    /**
     * Get all items
     *
     * @return Item[]
     */
    public function items()
    {
        return $this->items;
    }
}
