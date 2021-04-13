<?php

/*
 * This file is part of the SgDatatablesBundle project.
 *
 * Copyright (c) 2021. stwe <https://github.com/stwe/DatatablesBundle>
 *
 * License: MIT
 */

namespace Sg\DatatablesBundle\Datatable\Renderer;

use ArrayObject;

/**
 * Class RendererArrayObject
 *
 * @package Sg\DatatablesBundle\Datatable\Renderer
 */
class RendererArrayObject extends ArrayObject
{
    //-------------------------------------------------
    // Override
    //-------------------------------------------------

    /**
     * RendererArrayObject constructor.
     *
     * @param RendererInterface ...$renderer
     */
    public function __construct(RendererInterface ...$renderer)
    {
        parent::__construct($renderer);

        $this->setIteratorClass(RendererArrayIterator::class);
    }
}
