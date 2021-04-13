<?php

/*
 * This file is part of the SgDatatablesBundle project.
 *
 * Copyright (c) 2021. stwe <https://github.com/stwe/DatatablesBundle>
 *
 * License: MIT
 */

namespace Sg\DatatablesBundle\Datatable\Column;

use ArrayIterator;

/**
 * Class ColumnArrayIterator
 *
 * @package Sg\DatatablesBundle\Datatable\Column
 */
class ColumnArrayIterator extends ArrayIterator
{
    //-------------------------------------------------
    // Override
    //-------------------------------------------------

    /**
     * Return current array entry.
     *
     * @return ColumnInterface The current array entry.
     */
    public function current(): ColumnInterface
    {
        return parent::current();
    }
}
