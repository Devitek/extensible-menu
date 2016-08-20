<?php

namespace Devitek\Menu\Renderer\AdminLTE;

use Devitek\Menu\Items\Group;
use Devitek\Menu\Items\Item;
use Devitek\Menu\Items\Link;
use Devitek\Menu\Items\WithIcon;
use Devitek\Menu\Menu;
use Devitek\Menu\Renderer;

class AdminLTESidebar extends Renderer
{
    /**
     * @var Menu
     */
    protected $menu;

    /**
     * Get the output
     *
     * @return string
     */
    public function render()
    {
        return vsprintf('
            <ul class="sidebar-menu">
                %s
            </ul>
        ', [
            $this->getMenu()
        ]);
    }

    /**
     * Set the menu
     *
     * @param Menu $menu
     *
     * @return $this
     */
    public function thatContains(Menu $menu)
    {
        $this->menu = $menu;

        return $this;
    }

    /**
     * @return string
     */
    protected function getMenu()
    {
        if (null === $this->menu) {
            return '';
        }

        $html = '';

        foreach ($this->menu->items() as $item) {
            if (! $item->hasAccess()) {
                continue;
            }

            if ($item instanceof Group) {
                $html .= $this->renderTreeview($item);
            } else {
                $html .= $this->renderItem($item);
            }
        }

        return $html;
    }

    /**
     * Render a list item
     *
     * @param Item $item
     *
     * @return string
     */
    protected function renderItem(Item $item)
    {
        $template = '<li class="%s"><a href="%s">%s</a></li>';
        $value    = (null === $this->getTranslator() ? $item->value() : $this->getTranslator()->translate($item->value()));

        if (in_array(WithIcon::class, class_uses($item))) {
            /** @var WithIcon $item */
            $value = sprintf('<i class="%s"></i> <span>%s</span>', $item->icon(), $value);
        }

        return vsprintf($template, [
            $this->getResolver()->match($item) ? 'active' : '',
            $item instanceof Link ? $this->getResolver()->getUrl($item->destination(), $item->params()) : '#',
            $value,
        ]);
    }

    /**
     * Render a treeview
     *
     * @param Group $group
     *
     * @return string
     */
    protected function renderTreeview(Group $group)
    {
        $match    = false;
        $html     = '';
        $template = '
            <li class="treeview %s">
                <a href="#">
                    <i class="%s"></i> <span>%s</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    %s
                </ul>
            </li>
        ';

        foreach ($group->items() as $item) {
            if (! $item->hasAccess()) {
                continue;
            }

            if ($item instanceof Group) {
                $html .= $this->renderTreeview($item);
            } else {
                $html .= $this->renderItem($item);

                if ($this->getResolver()->match($item)) {
                    $match = true;
                }
            }
        }

        if (in_array(WithIcon::class, class_uses($group))) {
            /** @var WithIcon $group */
            $icon = $group->icon();
        } else {
            $icon = '';
        }

        $value = (null === $this->getTranslator() ? $group->value() : $this->getTranslator()->translate($group->value()));

        return sprintf($template, $match ? 'active' : '', $icon, $value, $html);
    }
}
