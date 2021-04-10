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
use JsonSerializable;

class ColumnArrayObject extends ArrayObject implements JsonSerializable
{
    //-------------------------------------------------
    // Override
    //-------------------------------------------------

    /**
     * ColumnArrayObject constructor.
     *
     * @param ColumnInterface ...$columns
     */
    public function __construct(ColumnInterface ...$columns)
    {
        parent::__construct($columns);

        $this->setIteratorClass(ColumnArrayIterator::class);
    }

    //-------------------------------------------------
    // Implement JsonSerializable
    //-------------------------------------------------

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return
            [
                'columns' => $this->getArrayCopy()
            ];
    }
}
