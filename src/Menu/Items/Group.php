<?php

namespace Devitek\Menu\Items;

class Group extends Item
{
    /**
     * @var array
     */
    protected $subItems;

    /**
     * Set the subitems
     *
     * @param array $subItems
     * @return $this
     */
    public function withUnder(array $subItems = [])
    {
        $this->subItems = $subItems;

        return $this;
    }

    /**
     * Get the subitems
     *
     * @return Item[]
     */
    public function items()
    {
        return $this->subItems;
    }
}