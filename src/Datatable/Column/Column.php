<?php

/*
 * This file is part of the SgDatatablesBundle project.
 *
 * Copyright (c) 2021. stwe <https://github.com/stwe/DatatablesBundle>
 *
 * License: MIT
 */

namespace Sg\DatatablesBundle\Datatable\Column;

use InvalidArgumentException;
use JsonSerializable;
use Sg\DatatablesBundle\Datatable\Renderer\RendererInterface;
use Sg\DatatablesBundle\Datatable\Widget\WidgetArrayObject;
use Sg\DatatablesBundle\Datatable\Widget\WidgetInterface;

class Column implements JsonSerializable
{
    /**
     * @var string
     */
    private string $dql;

    /**
     * @var ColumnBuilder
     */
    private ColumnBuilder $columnBuilder;

    /**
     * @var WidgetArrayObject
     */
    private WidgetArrayObject $widgets;

    /**
     * @var RendererInterface
     */
    private RendererInterface $renderer;

    //-------------------------------------------------
    // Ctor.
    //-------------------------------------------------

    /**
     * Column constructor.
     *
     * @param ColumnBuilder $columnBuilder
     */
    public function __construct(ColumnBuilder $columnBuilder)
    {
        $this->columnBuilder = $columnBuilder;
        $this->widgets = new WidgetArrayObject();
    }

    //-------------------------------------------------
    // Getter
    //-------------------------------------------------

    /**
     * @return string
     */
    public function getDql(): string
    {
        return $this->dql;
    }

    /**
     * @return ColumnBuilder
     */
    public function getColumnBuilder(): ColumnBuilder
    {
        return $this->columnBuilder;
    }

    /**
     * @return WidgetArrayObject
     */
    public function getWidgets(): WidgetArrayObject
    {
        return $this->widgets;
    }

    /**
     * @return RendererInterface
     */
    public function getRenderer(): RendererInterface
    {
        return $this->renderer;
    }

    //-------------------------------------------------
    // Setter
    //-------------------------------------------------

    /**
     * @param string $dql
     */
    public function setDql(string $dql): void
    {
        $this->dql = $dql;
    }

    /**
     * @param WidgetInterface $widget
     */
    public function addWidget(WidgetInterface $widget): void
    {
        $id = get_class($widget);
        if (!$this->widgets->offsetExists($id)) {
            $this->widgets->offsetSet($id, $widget);
        } else {
            throw new InvalidArgumentException("Widget $id already exists.");
        }
    }

    /**
     * @param RendererInterface $renderer
     */
    public function setRenderer(RendererInterface $renderer): void
    {
        $renderer->setColumn($this);
        $this->renderer = $renderer;
    }

    //-------------------------------------------------
    // Implement JsonSerializable
    //-------------------------------------------------

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return
            [
                'dql' => $this->getDql(),
            ];
    }
}
