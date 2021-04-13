<?php

namespace Sg\DatatablesBundle\Datatable\Renderer;

use ArrayIterator;

/**
 * Class RendererArrayIterator
 *
 * @package Sg\DatatablesBundle\Datatable\Renderer
 */
class RendererArrayIterator extends ArrayIterator
{
    //-------------------------------------------------
    // Override
    //-------------------------------------------------

    /**
     * Return current array entry.
     *
     * @return RendererInterface
     */
    public function current(): RendererInterface
    {
        return parent::current();
    }
}
