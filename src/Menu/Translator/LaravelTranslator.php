<?php

namespace Devitek\Menu\Translator;

use Devitek\Menu\Translator;

class LaravelTranslator implements Translator
{
    /**
     * Translate the given text
     *
     * @param $text
     * @return string
     */
    public function translate($text)
    {
        return trans($text);
    }
}