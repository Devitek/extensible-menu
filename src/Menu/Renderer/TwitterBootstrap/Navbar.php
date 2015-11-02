<?php

namespace Devitek\Menu\Renderer\TwitterBootstrap;

use Devitek\Menu\Items\Group;
use Devitek\Menu\Items\Item;
use Devitek\Menu\Items\Link;
use Devitek\Menu\Items\WithIcon;
use Devitek\Menu\Menu;
use Devitek\Menu\Renderer;

class Navbar extends Renderer
{
    /**
     * @var bool
     */
    protected $isFluid = false;

    /**
     * @var bool
     */
    protected $handleResponsive = false;

    /**
     * @var bool
     */
    protected $isFixedTop = false;

    /**
     * @var bool
     */
    protected $isFixedBottom = false;

    /**
     * @var bool
     */
    protected $isStaticTop = false;

    /**
     * @var bool
     */
    protected $isInversed = false;

    /**
     * @var string
     */
    protected $brand = null;

    /**
     * @var string
     */
    protected $brandUrl = '#';

    /**
     * @var Menu
     */
    protected $onTheRight = null;

    /**
     * @var Menu
     */
    protected $onTheLeft = null;

    /**
     * Get the output
     *
     * @return string
     */
    public function render()
    {
        $color = $this->isInversed ? 'navbar-inverse' : 'navbar-default';
        $fixed = $this->isFixedTop ? 'navbar-fixed-top' : ($this->isFixedBottom ? 'navbar-fixed-bottom' : ($this->isStaticTop ? 'navbar-static-top' : ''));
        $fluid = $this->isFluid ? 'container-fluid' : 'container';
        $header = $this->getHeader();
        $menu = $this->getMenu();

        return vsprintf('
            <nav class="navbar %s %s">
                <div class="%s">
                    %s
                    %s
                </div>
            </nav>
        ', [
            $color,
            $fixed,
            $fluid,
            $header,
            $menu,
        ]);
    }

    /**
     * Set if the navbar is fluid
     *
     * @param boolean $isFluid
     * @return Navbar
     */
    public function isFluid($isFluid = true)
    {
        $this->isFluid = $isFluid;

        return $this;
    }

    /**
     * Set if the menu should handle RWD
     *
     * @param boolean $handleResponsive
     * @return Navbar
     */
    public function handleResponsive($handleResponsive = true)
    {
        $this->handleResponsive = $handleResponsive;

        return $this;
    }

    /**
     * Set if the navbar is fixed at the top
     *
     * @param boolean $isFixedTop
     * @return Navbar
     */
    public function isFixedTop($isFixedTop = true)
    {
        $this->isFixedTop = $isFixedTop;

        return $this;
    }

    /**
     * Set if the navbar is fixed at the bottom
     *
     * @param boolean $isFixedBottom
     * @return Navbar
     */
    public function isFixedBottom($isFixedBottom = true)
    {
        $this->isFixedBottom = $isFixedBottom;

        return $this;
    }

    /**
     * Set if the navbar is static top
     *
     * @param boolean $isStaticTop
     * @return Navbar
     */
    public function isStaticTop($isStaticTop = true)
    {
        $this->isStaticTop = $isStaticTop;

        return $this;
    }

    /**
     * Set if the color is inversed
     *
     * @param boolean $isInversed
     * @return Navbar
     */
    public function isInversed($isInversed = true)
    {
        $this->isInversed = $isInversed;

        return $this;
    }

    /**
     * Set the brand
     *
     * @param string $brand
     * @param string $url
     * @return Navbar
     */
    public function withBrand($brand, $url = '#')
    {
        $this->brand = $brand;
        $this->brandUrl = $url;

        return $this;
    }

    /**
     * Set the left menu
     *
     * @param Menu $onTheLeft
     * @return Navbar
     */
    public function onTheLeft(Menu $onTheLeft)
    {
        $this->onTheLeft = $onTheLeft;

        return $this;
    }

    /**
     * Set the right menu
     *
     * @param Menu $onTheRight
     * @return Navbar
     */
    public function onTheRight(Menu $onTheRight)
    {
        $this->onTheRight = $onTheRight;

        return $this;
    }

    /**
     * Get the navbar
     *
     * @return string
     */
    protected function getHeader()
    {
        if (!$this->brand && !$this->handleResponsive) {
            return '';
        }

        $brand = $this->brand ? sprintf('<a class="navbar-brand" href="%s">%s</a>', $this->brandUrl, $this->brand) : '';

        return vsprintf('
            %s
            %s
        ', [
            $this->renderHamburger(),
            $brand,
        ]);
    }

    /**
     * Get the full menu
     *
     * @return string
     */
    protected function getMenu()
    {
        return vsprintf('
            <div id="navbar" class="collapse navbar-collapse">
                %s
                %s
            </div>
        ', [
            $this->renderMenu($this->onTheLeft),
            $this->renderMenu($this->onTheRight, true),
        ]);
    }

    /**
     * Render the famous hamburger
     *
     * @return string
     */
    protected function renderHamburger()
    {
        return '
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        ';
    }

    /**
     * Render the given menu and put it to the right if needed
     *
     * @param Menu $menu
     * @param bool $onTheRight
     * @return string
     */
    protected function renderMenu(Menu $menu = null, $onTheRight = false)
    {
        if (null === $menu) {
            return '';
        }

        $html = '';
        $template = '
            <ul class="nav navbar-nav %s">
                %s
            </ul>
        ';

        foreach ($menu->items() as $item) {
            if (! $item->hasAccess()) {
                continue;
            }

            if ($item instanceof Group) {
                $html .= $this->renderDropdown($item);
            } else {
                $html .= $this->renderItem($item);
            }
        }

        return vsprintf($template, [
            $onTheRight ? 'navbar-right' : '',
            $html,
        ]);
    }

    /**
     * Render a list item
     *
     * @param Item $item
     * @return string
     */
    protected function renderItem(Item $item)
    {
        $template = '<li class="%s"><a href="%s">%s</a></li>';
        $value = (null === $this->getTranslator() ? $item->value() : $this->getTranslator()->translate($item->value()));

        if (in_array(WithIcon::class, class_uses($item))) {
            /** @var WithIcon $item */
            $value = sprintf('<i class="%s"></i> %s', $item->icon(), $value);
        }

        return vsprintf($template, [
            $this->getResolver()->match($item) ? 'active' : '',
            $item instanceof Link ? $this->getResolver()->getUrl($item->destination(), $item->params()) : '#',
            $value,
        ]);
    }

    /**
     * Render a dropdown
     *
     * @param Group $group
     * @return string
     */
    protected function renderDropdown(Group $group)
    {
        $html = '';
        $template = '
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-cog"></i> Administration <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    %s
                </ul>
            </li>
        ';

        foreach ($group->items() as $item) {
            if (! $item->hasAccess()) {
                continue;
            }

            $html .= $this->renderItem($item);
        }

        return sprintf($template, $html);
    }
}