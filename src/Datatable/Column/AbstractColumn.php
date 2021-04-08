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
use Sg\DatatablesBundle\Datatable\DatatableInterface;
use Sg\DatatablesBundle\Datatable\Renderer\RendererInterface;
use Sg\DatatablesBundle\Datatable\Widget\WidgetArrayObject;
use Sg\DatatablesBundle\Datatable\Widget\WidgetInterface;

abstract class AbstractColumn implements ColumnInterface, JsonSerializable
{
    /**
     * The parent Datatable object.
     *
     * @var DatatableInterface
     */
    private DatatableInterface $datatable;

    /**
     * @var string
     */
    private string $dql;

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
     */
    public function __construct()
    {
        $this->widgets = new WidgetArrayObject();
    }

    //-------------------------------------------------
    // Getter
    //-------------------------------------------------

    /**
     * @return DatatableInterface
     */
    public function getDatatable(): DatatableInterface
    {
        return $this->datatable;
    }

    /**
     * @return string
     */
    public function getDql(): string
    {
        return $this->dql;
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
    // Implement ColumnInterface
    //-------------------------------------------------

    /**
     * @param DatatableInterface $datatable
     */
    public function setDatatable(DatatableInterface $datatable): void
    {
        $this->datatable = $datatable;
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
