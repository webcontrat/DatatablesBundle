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
use Sg\DatatablesBundle\Datatable\Widget\BooleanWidget;

/**
 * Class BooleanRenderer
 *
 * @package Sg\DatatablesBundle\Datatable\Renderer
 */
class BooleanRenderer extends AbstractRenderer
{
    //-------------------------------------------------
    // Implement RendererInterface
    //-------------------------------------------------

    public function renderColumn(ColumnInterface $column, $rawValue): string
    {
        $twig = $column->getDatatable()->getTwig();
        $widgets = $column->getWidgets();

        /**
         * @var BooleanWidget $booleanWidget
         */
        $booleanWidget = $widgets->offsetGet(BooleanWidget::class);

        $invalidValue = false;
        $result = '';
        $class = '';

        // cast if no bool, but 0 or 1
        if (!is_bool($rawValue) && in_array($rawValue, [0, 1, '0', '1'], true)) {
            $rawValue = (bool) $rawValue;
        }

        // now it should be bool
        if (is_bool($rawValue)) {
            // set label && icon
            $result = $booleanWidget->getTrueLabel();
            $class = $booleanWidget->getTrueIcon();
            if ($rawValue === false) {
                $result = $booleanWidget->getFalseLabel();
                $class = $booleanWidget->getFalseIcon();
            }

            if ($booleanWidget->isPreferIcons()) {
                $result = '';
            }
        } else {
            // otherwise the value is invalid
            $invalidValue = true;
        }

        return $twig->render(
            '@SgDatatables/renderer/boolean.html.twig',
            [
                'invalid_value' => $invalidValue,
                'class' => $class,
                'result' => $result
            ]
        );
    }
}
