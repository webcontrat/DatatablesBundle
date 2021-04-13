<?php

/*
 * This file is part of the SgDatatablesBundle project.
 *
 * Copyright (c) 2021. stwe <https://github.com/stwe/DatatablesBundle>
 *
 * License: MIT
 */

namespace Sg\DatatablesBundle\Datatable\Widget;

use ArrayIterator;

/**
 * Class WidgetArrayIterator
 *
 * @package Sg\DatatablesBundle\Datatable\Widget
 */
class WidgetArrayIterator extends ArrayIterator
{
    //-------------------------------------------------
    // Override
    //-------------------------------------------------

    /**
     * Return current array entry.
     *
     * @return WidgetInterface The current array entry.
     */
    public function current(): WidgetInterface
    {
        return parent::current();
    }
}
