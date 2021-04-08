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
use Sg\DatatablesBundle\Datatable\Widget\WidgetArrayObject;

interface RendererInterface
{
    public function getColumn(): ColumnInterface;
    public function setColumn(ColumnInterface $column): void;
    public function checkForWidgetTypes(WidgetArrayObject $widgets): void;

    public function render($rawValue): string;
    public function getWidgetTypes(): array;
}
