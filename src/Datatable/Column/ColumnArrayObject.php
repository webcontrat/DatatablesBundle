<?php

/*
 * This file is part of the SgDatatablesBundle project.
 *
 * Copyright (c) 2021. stwe <https://github.com/stwe/DatatablesBundle>
 *
 * License: MIT
 */

namespace Sg\DatatablesBundle\Datatable\Column;

use ArrayObject;

class ColumnArrayObject extends ArrayObject
{
    //-------------------------------------------------
    // Override
    //-------------------------------------------------

    /**
     * ColumnArrayObject constructor.
     *
     * @param Column ...$columns
     */
    public function __construct(Column ...$columns)
    {
        parent::__construct($columns);

        $this->setIteratorClass(ColumnArrayIterator::class);
    }
}
