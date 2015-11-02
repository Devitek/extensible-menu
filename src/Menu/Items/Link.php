<?php

namespace Devitek\Menu\Items;

class Link extends Item
{
    /**
     * @var string
     */
    protected $destination;

    /**
     * @var array
     */
    protected $params = [];

    /**
     * @param $destination
     * @return $this
     */
    public function withDestination($destination)
    {
        $this->destination = $destination;

        return $this;
    }

    /**
     * @return string
     */
    public function destination()
    {
        return $this->destination;
    }

    public function withParams(array $params = [])
    {
        $this->params = $params;

        return $this;
    }

    /**
     * @return array
     */
    public function params()
    {
        return $this->params;
    }
}