<?php

/*
 * This file is part of the SgDatatablesBundle project.
 *
 * Copyright (c) 2021. stwe <https://github.com/stwe/DatatablesBundle>
 *
 * License: MIT
 */

namespace Sg\DatatablesBundle\Datatable\Widget;

use ArrayObject;

/**
 * Class WidgetArrayObject
 *
 * @package Sg\DatatablesBundle\Datatable\Widget
 */
class WidgetArrayObject extends ArrayObject
{
    //-------------------------------------------------
    // Override
    //-------------------------------------------------

    /**
     * WidgetArrayObject constructor.
     *
     * @param WidgetInterface ...$widgets
     */
    public function __construct(WidgetInterface ...$widgets)
    {
        parent::__construct($widgets);

        $this->setIteratorClass(WidgetArrayIterator::class);
    }
}
