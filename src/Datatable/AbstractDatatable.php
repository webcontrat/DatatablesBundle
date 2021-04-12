<?php

/*
 * This file is part of the SgDatatablesBundle project.
 *
 * Copyright (c) 2021. stwe <https://github.com/stwe/DatatablesBundle>
 *
 * License: MIT
 */

namespace Sg\DatatablesBundle\Datatable;

use Psr\Log\LoggerInterface;
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
     * Inject LoggerInterface.
     *
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

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
     * @param LoggerInterface $logger
     */
    public function __construct(
        Environment $twig,
        UrlGeneratorInterface $router,
        LoggerInterface $logger
    )
    {
        $this->twig = $twig;
        $this->router = $router;
        $this->logger = $logger;

        $this->columns = new ColumnArrayObject();

        $this->ajax = new Ajax();
        $this->features = new Features();

        $this->log('__construct', 'object was created');
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

        $this->log('addColumn', 'column ' . get_class($column) . ' was added');
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

    //-------------------------------------------------
    // Helper
    //-------------------------------------------------

    /**
     * Log helper.
     *
     * @param string $method
     * @param string $text
     */
    private function log(string $method, string $text): void
    {
        $id = $this->getId();
        $this->logger->debug("[AbstractDatatable::$method()]: Datatable Id $id: $text");
    }
}
