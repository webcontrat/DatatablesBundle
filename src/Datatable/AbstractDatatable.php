<?php

/*
 * This file is part of the SgDatatablesBundle project.
 *
 * Copyright (c) 2021. stwe <https://github.com/stwe/DatatablesBundle>
 *
 * License: MIT
 */

namespace Sg\DatatablesBundle\Datatable;

use Sg\DatatablesBundle\Datatable\Column\ColumnInterface;
use Twig\Environment;
use Sg\DatatablesBundle\Datatable\Column\ColumnArrayObject;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Class AbstractDatatable
 *
 * @package Sg\DatatablesBundle\Datatable
 */
abstract class AbstractDatatable implements DatatableInterface
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
     * Ajax control object.
     * It is possible to reading table information directly
     * from the DOM. But in most cases an ajax source is needed.
     * Therefore an instance is created in the constructor. Its
     * options, however, are all set to null by default.
     *
     * @var Ajax
     */
    private Ajax $ajax;

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

        $this->ajax = new Ajax();
        $this->features = new Features();
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
     * @return Ajax
     */
    public function getAjax(): Ajax
    {
        return $this->ajax;
    }

    /**
     * @return Features
     */
    public function getFeatures(): Features
    {
        return $this->features;
    }
}
