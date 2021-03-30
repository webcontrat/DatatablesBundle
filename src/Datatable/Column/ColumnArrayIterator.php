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

class ColumnArrayIterator extends ArrayIterator
{
    //-------------------------------------------------
    // Override
    //-------------------------------------------------

    /**
     * @return Column
     */
    public function current(): Column
    {
        return parent::current();
    }
}
