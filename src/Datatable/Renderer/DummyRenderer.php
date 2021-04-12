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
use Sg\DatatablesBundle\Datatable\Column\ColumnInterface;
use Sg\DatatablesBundle\Datatable\Widget\BooleanWidget;
use Sg\DatatablesBundle\Datatable\Widget\HtmlFormatWidget;

/**
 * Class DummyRenderer
 *
 * @package Sg\DatatablesBundle\Datatable\Renderer
 */
class DummyRenderer extends AbstractRenderer
{
    //-------------------------------------------------
    // Implement RendererInterface
    //-------------------------------------------------

    /**
     * @param ColumnInterface $column
     * @param $rawValue
     *
     * @return string
     *
     * @throws Exception
     */
    public function renderColumn(ColumnInterface $column, $rawValue): string
    {
        // get Twig
        $twig = $column->getDatatable()->getTwig();

        // get and check Widgets
        $widgets = $column->getWidgets();
        $this->checkForWidgetTypes($widgets);

        $booleanWidget = $widgets->offsetGet(BooleanWidget::class);
        $htmlFormatWidget = $widgets->offsetGet(HtmlFormatWidget::class);
        $result = 'Default';

        // output
        if (is_bool($rawValue)) {
            $result = $booleanWidget->getTrueLabel();
            if ($rawValue === false) {
                $result = $booleanWidget->getFalseLabel();
            }
        }

        if (is_string($rawValue)) {
            $result = empty($rawValue) ? $booleanWidget->getFalseLabel() : $booleanWidget->getTrueLabel();
        }

        return $twig->render(
            '@SgDatatables/renderer/dummy.html.twig',
            [
                'value' => $result,
                'is_bold' => $htmlFormatWidget->isBold(),
                'is_italic' => $htmlFormatWidget->isItalic()
            ]
        );
    }

    /**
     * @return string[]
     */
    public function getWidgetTypes(): array
    {
        return [
            BooleanWidget::class,
            HtmlFormatWidget::class
        ];
    }
}
