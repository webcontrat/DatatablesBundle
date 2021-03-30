<?php

/*
 * This file is part of the SgDatatablesBundle project.
 *
 * Copyright (c) 2021. stwe <https://github.com/stwe/DatatablesBundle>
 *
 * License: MIT
 */

namespace Sg\DatatablesBundle\Datatable\Renderer;

use Exception;
use Sg\DatatablesBundle\Datatable\Column\Column;
use Sg\DatatablesBundle\Datatable\Widget\WidgetArrayObject;

abstract class AbstractRenderer implements RendererInterface
{
    /**
     * @var Column
     */
    private Column $column;

    //-------------------------------------------------
    // Implement RendererInterface
    //-------------------------------------------------

    /**
     * @return Column
     */
    public function getColumn(): Column
    {
        return $this->column;
    }

    /**
     * @param Column $column
     */
    public function setColumn(Column $column): void
    {
        $this->column = $column;
    }

    /**
     * @param WidgetArrayObject $widgets
     * @throws Exception
     */
    public function checkForWidgetTypes(WidgetArrayObject $widgets): void
    {
        foreach ($this->getWidgetTypes() as $widgetType) {
            if (!$widgets->offsetExists($widgetType)) {
                throw new Exception('Missing Widget');
            }
        }
    }
}
