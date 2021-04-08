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

interface ColumnInterface
{
    public function buildColumn();
    public function setDatatable(DatatableInterface $datatable): void;
    public function getDatatableId(): string;
}
