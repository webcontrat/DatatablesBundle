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
use Sg\DatatablesBundle\Datatable\Widget\WidgetArrayObject;

/**
 * Class AbstractRenderer
 *
 * @package Sg\DatatablesBundle\Datatable\Renderer
 */
abstract class AbstractRenderer implements RendererInterface
{
    //-------------------------------------------------
    // Implement RendererInterface
    //-------------------------------------------------

    /**
     * @param WidgetArrayObject $widgets
     *
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
