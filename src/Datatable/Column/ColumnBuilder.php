<?php

/*
 * This file is part of the SgDatatablesBundle project.
 *
 * Copyright (c) 2021. stwe <https://github.com/stwe/DatatablesBundle>
 *
 * License: MIT
 */

namespace Sg\DatatablesBundle\Datatable\Column;

use Sg\DatatablesBundle\Datatable\DatatableInterface;

class ColumnBuilder
{
    /**
     * @var DatatableInterface
     */
    private DatatableInterface $datatable;

    /**
     * @var ColumnArrayObject
     */
    private ColumnArrayObject $columns;

    //-------------------------------------------------
    // Ctor.
    //-------------------------------------------------

    /**
     * ColumnBuilder constructor.
     *
     * @param DatatableInterface $datatable
     */
    public function __construct(DatatableInterface $datatable)
    {
        $this->datatable = $datatable;
        $this->columns = new ColumnArrayObject();
    }

    //-------------------------------------------------
    // Getter
    //-------------------------------------------------

    /**
     * @return DatatableInterface
     */
    public function getDatatable(): DatatableInterface
    {
        return $this->datatable;
    }

    /**
     * @return ColumnArrayObject
     */
    public function getColumns(): ColumnArrayObject
    {
        return $this->columns;
    }

    //-------------------------------------------------
    // Add
    //-------------------------------------------------

    /**
     * @param string $dql
     */
    public function addColumn(string $dql): void
    {
        $column = new Column($this);
        $column->setDql($dql);

        $this->columns->append($column);
    }
}
