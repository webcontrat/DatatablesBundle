<?php

/*
 * This file is part of the SgDatatablesBundle project.
 *
 * Copyright (c) 2021. stwe <https://github.com/stwe/DatatablesBundle>
 *
 * License: MIT
 */

namespace Sg\DatatablesBundle\Datatable;

use JsonSerializable;
use Sg\DatatablesBundle\Datatable\Column\ColumnInterface;
use Twig\Environment;
use Sg\DatatablesBundle\Datatable\Column\ColumnArrayObject;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

abstract class AbstractDatatable implements DatatableInterface, JsonSerializable
{
    /**
     * Inject Environment.
     *
     * @var Environment
     */
    private Environment $twig;

    /**
     * Inject UrlGeneratorInterface (Router).
     *
     * @var UrlGeneratorInterface
     */
    private UrlGeneratorInterface $router;

    /**
     * The Column objects of this Datatable.
     *
     * @var ColumnArrayObject
     */
    private ColumnArrayObject $columns;

    /**
     * Load data for the table's content from an Ajax source.
     * For the initialization, the Html5 data-ajax attribute is read later,
     * so it must be ensured that only valid options are used.
     *
     * @link https://datatables.net/examples/ajax/
     *
     * @var array
     */
    private array $ajax;

    /**
     * Feature control object.
     *
     * @var Features
     */
    private Features $features;

    //-------------------------------------------------
    // Ctor.
    //-------------------------------------------------

    /**
     * AbstractDatatable constructor.
     *
     * @param Environment $twig
     * @param UrlGeneratorInterface $router
     */
    public function __construct(Environment $twig, UrlGeneratorInterface $router)
    {
        $this->twig = $twig;
        $this->router = $router;

        $this->columns = new ColumnArrayObject();
        $this->ajax = [];
        $this->features = new Features();
    }

    //-------------------------------------------------
    // Getter
    //-------------------------------------------------

    /**
     * @return Features
     */
    public function getFeatures(): Features
    {
        return $this->features;
    }

    //-------------------------------------------------
    // Implement DatatableInterface
    //-------------------------------------------------

    /**
     * @return Environment
     */
    public function getTwig(): Environment
    {
        return $this->twig;
    }

    /**
     * @return UrlGeneratorInterface
     */
    public function getRouter(): UrlGeneratorInterface
    {
        return $this->router;
    }

    /**
     * @return ColumnArrayObject
     */
    public function getColumns(): ColumnArrayObject
    {
        return $this->columns;
    }

    /**
     * @param ColumnInterface $column
     */
    public function addColumn(ColumnInterface $column): void
    {
        $column->setDatatable($this);
        $this->columns->append($column);
    }

    /**
     * @return array
     */
    public function getAjax(): array
    {
        return $this->ajax;
    }

    /**
     * Set @see $ajax
     *
     * @param array $options An array of valid ajax options.
     */
    public function setAjax(array $options): void
    {
        $this->ajax = $options;
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
                'columns' => $this->columns->getArrayCopy(),
            ];
    }
}
