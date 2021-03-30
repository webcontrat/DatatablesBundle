<?php

/*
 * This file is part of the SgDatatablesBundle project.
 *
 * Copyright (c) 2021. stwe <https://github.com/stwe/DatatablesBundle>
 *
 * License: MIT
 */

namespace Sg\DatatablesBundle\Datatable\Renderer;

use Sg\DatatablesBundle\Datatable\Widget\BooleanWidget;
use Sg\DatatablesBundle\Datatable\Widget\HtmlFormatWidget;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class DummyRenderer extends AbstractRenderer
{
    //-------------------------------------------------
    // Override
    //-------------------------------------------------

    /**
     * @param mixed $rawValue
     *
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function render($rawValue): string
    {
        // get Twig
        $twig = $this->getColumn()->getColumnBuilder()->getDatatable()->getTwig();

        // get and check Widgets
        $widgets = $this->getColumn()->getWidgets();
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
