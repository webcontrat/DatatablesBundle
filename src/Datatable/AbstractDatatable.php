<?php

/*
 * This file is part of the SgDatatablesBundle project.
 *
 * Copyright (c) 2021. stwe <https://github.com/stwe/DatatablesBundle>
 *
 * License: MIT
 */

namespace Sg\DatatablesBundle\Datatable;

use Sg\DatatablesBundle\Datatable\Column\ColumnBuilder;
use Twig\Environment;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

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
     * Column container.
     *
     * @var ColumnBuilder
     */
    private ColumnBuilder $columnBuilder;

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
        $this->columnBuilder = new ColumnBuilder($this);
        $this->ajax = [];
    }

    //-------------------------------------------------
    // Implement DatatableInterface
    //--------------------------------------------------

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
     * @return ColumnBuilder
     */
    public function getColumnBuilder(): ColumnBuilder
    {
        return $this->columnBuilder;
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
}
