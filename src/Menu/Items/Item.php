<?php

namespace Devitek\Menu\Items;

abstract class Item
{
    /**
     * We need at least one condition to pass
     */
    const NEED_AT_LEAST_ONE = 'AT_LEAST_ONE';

    /**
     * We need all conditions to pass
     */
    const NEED_ALL = 'ALL';

    /**
     * @var string
     */
    protected $value;

    /**
     * @var array
     */
    protected $conditions;

    /**
     * @var string
     */
    protected $flag;

    /**
     * @param string $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * Set the conditions to display this item
     *
     * @param array  $conditions
     * @param string $flag
     *
     * @return $this
     */
    public function need(array $conditions = [], $flag = self::NEED_ALL)
    {
        $this->conditions = $conditions;
        $this->flag = $flag;

        return $this;
    }

    /**
     * Get the conditions to disply this item
     *
     * @return array
     */
    public function conditions()
    {
        return $this->conditions;
    }

    /**
     * Do we have access to this item ?
     *
     * @return bool
     */
    public function hasAccess()
    {
        switch ($this->flag) {
            case self::NEED_AT_LEAST_ONE:
                $access = false;

                foreach ($this->conditions() as $condition) {
                    if (is_callable($condition)) {
                        $access |= $condition();
                    } elseif ($condition) {
                        $access |= $condition;
                    }
                }

                return $access;
            case self::NEED_ALL:
                $access = true;

                foreach ($this->conditions() as $condition) {
                    if (is_callable($condition)) {
                        $access &= $condition();
                    } else {
                        $access &= $condition;
                    }
                }

                return $access;
        }

        return true;
    }

    /**
     * Get the value
     *
     * @return string
     */
    public function value()
    {
        return $this->value;
    }
}
