<?php

namespace Devitek\Menu;

abstract class Renderer
{
    /**
     * @var TranslatorInterface
     */
    protected $translator;

    /**
     * @var ResolverInterface
     */
    protected $resolver;

    /**
     * Set a translator

     *
*@param TranslatorInterface $translator
     *
*@return $this
     */
    public function translateWith(TranslatorInterface $translator)
    {
        $this->translator = $translator;

        return $this;
    }

    /**
     * Get the translator

     *
*@return TranslatorInterface
     */
    public function getTranslator()
    {
        return $this->translator;
    }

    /**
     * Set a resolver

     *
*@param ResolverInterface $resolver
     *
*@return $this
     */
    public function resolveUrlWith(ResolverInterface $resolver)
    {
        $this->resolver = $resolver;

        return $this;
    }

    /**
     * Get the URL resolver

     *
*@return ResolverInterface
     */
    public function getResolver()
    {
        return $this->resolver;
    }

    /**
     * Get the output
     *
     * @return string
     */
    public abstract function render();
}
