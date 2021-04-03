<?php

/*
 * This file is part of the SgDatatablesBundle project.
 *
 * Copyright (c) 2021. stwe <https://github.com/stwe/DatatablesBundle>
 *
 * License: MIT
 */

namespace Sg\DatatablesBundle\Datatables;

use ArrayIterator;
use Sg\DatatablesBundle\Datatable\DatatableInterface;

class DatatableArrayIterator extends ArrayIterator
{
    //-------------------------------------------------
    // Override
    //-------------------------------------------------

    /**
     * Return current array entry.
     *
     * @return DatatableInterface The current array entry.
     */
    public function current(): DatatableInterface
    {
        parent::current();
    }
}
