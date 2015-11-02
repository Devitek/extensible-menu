<?php

namespace Devitek\Menu\Items;

trait WithIcon
{
    /**
     * @var string
     */
    protected $icon;

    /**
     * @param $icon
     * @return $this
     */
    public function withIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * @return string
     */
    public function icon()
    {
        return $this->icon;
    }
}