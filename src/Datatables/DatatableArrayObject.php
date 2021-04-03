<?php

/*
 * This file is part of the SgDatatablesBundle project.
 *
 * Copyright (c) 2021. stwe <https://github.com/stwe/DatatablesBundle>
 *
 * License: MIT
 */

namespace Sg\DatatablesBundle\Datatables;

use ArrayObject;
use Sg\DatatablesBundle\Datatable\DatatableInterface;

class DatatableArrayObject extends ArrayObject
{
    //-------------------------------------------------
    // Override
    //-------------------------------------------------

    /**
     * DatatableArrayObject constructor.
     *
     * @param DatatableInterface ...$datatables
     */
    public function __construct(DatatableInterface ...$datatables)
    {
        parent::__construct($datatables);

        $this->setIteratorClass(DatatableArrayIterator::class);
    }
}
