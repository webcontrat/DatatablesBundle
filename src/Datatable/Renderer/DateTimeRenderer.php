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
use Sg\DatatablesBundle\Datatable\Widget\DateTimeWidget;

/**
 * Class DateTimeRenderer
 *
 * @package Sg\DatatablesBundle\Datatable\Renderer
 */
class DateTimeRenderer extends AbstractRenderer
{
    //-------------------------------------------------
    // Implement RendererInterface
    //-------------------------------------------------

    public function renderColumn(ColumnInterface $column, $rawValue): string
    {
        $twig = $column->getDatatable()->getTwig();
        $widgets = $column->getWidgets();

        /**
         * @var DateTimeWidget $dateTimeWidget
         */
        $dateTimeWidget = $widgets->offsetGet(DateTimeWidget::class);

        return $twig->render(
            '@SgDatatables/renderer/dateTime.html.twig',
            [
                'format' => $dateTimeWidget->getFormat(),
                'result' => $rawValue
            ]
        );
    }
}
