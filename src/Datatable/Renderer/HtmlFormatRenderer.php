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
use Sg\DatatablesBundle\Datatable\Widget\HtmlFormatWidget;

/**
 * Class HtmlFormatRenderer
 *
 * @package Sg\DatatablesBundle\Datatable\Renderer
 */
class HtmlFormatRenderer extends AbstractRenderer
{
    //-------------------------------------------------
    // Implement RendererInterface
    //-------------------------------------------------

    public function renderColumn(ColumnInterface $column, $rawValue): string
    {
        $twig = $column->getDatatable()->getTwig();
        $widgets = $column->getWidgets();

        /**
         * @var HtmlFormatWidget $htmlFormatWidget
         */
        $htmlFormatWidget = $widgets->offsetGet(HtmlFormatWidget::class);

        $tags = $htmlFormatWidget->getTags();

        $result = '';
        foreach($tags as $tag) {
            $result .= '<' . $tag . '>';
        }

        $result .= $rawValue;

        foreach($tags as $tag) {
            $result .= '</' . $tag . '>';
        }

        return $twig->render(
            '@SgDatatables/renderer/htmlFormat.html.twig',
            [
                'result' => $result
            ]
        );
    }
}
