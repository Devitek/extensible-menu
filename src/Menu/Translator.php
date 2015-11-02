<?php

namespace Devitek\Menu;

interface Translator
{
    /**
     * Translate the given text
     *
     * @param $text
     * @return string
     */
    public function translate($text);
}