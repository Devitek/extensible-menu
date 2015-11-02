<?php

namespace Devitek\Menu;

abstract class Renderer
{
    /**
     * @var Translator
     */
    protected $translator;

    /**
     * @var Resolver
     */
    protected $resolver;

    /**
     * Set a translator
     *
     * @param Translator $translator
     * @return $this
     */
    public function translateWith(Translator $translator)
    {
        $this->translator = $translator;

        return $this;
    }

    /**
     * Get the translator
     *
     * @return Translator
     */
    public function getTranslator()
    {
        return $this->translator;
    }

    /**
     * Set a resolver
     *
     * @param Resolver $resolver
     * @return $this
     */
    public function resolveUrlWith(Resolver $resolver)
    {
        $this->resolver = $resolver;

        return $this;
    }

    /**
     * Get the URL resolver
     *
     * @return Resolver
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