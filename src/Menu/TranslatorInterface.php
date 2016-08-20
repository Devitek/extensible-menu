<?php

namespace Devitek\Menu;

interface TranslatorInterface
{
    /**
     * Translate the given text
     *
     * @param $text
     * @return string
     */
    public function translate($text);
}
