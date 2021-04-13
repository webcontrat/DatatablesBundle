<?php

/*
 * This file is part of the SgDatatablesBundle project.
 *
 * Copyright (c) 2021. stwe <https://github.com/stwe/DatatablesBundle>
 *
 * License: MIT
 */

namespace Sg\DatatablesBundle\Datatable\Renderer;

use Sg\DatatablesBundle\Datatable\Column\ColumnInterface;

/**
 * Interface RendererInterface
 *
 * @package Sg\DatatablesBundle\Datatable\Renderer
 */
interface RendererInterface
{
    public function renderColumn(ColumnInterface $column, $rawValue): string;
}
