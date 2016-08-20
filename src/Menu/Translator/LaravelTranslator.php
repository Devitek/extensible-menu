<?php

namespace Devitek\Menu\Translator;

use Devitek\Menu\TranslatorInterface;

class LaravelTranslator implements TranslatorInterface
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
