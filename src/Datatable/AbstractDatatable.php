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

abstract class AbstractDatatable implements DatatableInterface
{
    /**
     * @var Environment
     */
    private Environment $twig;

    /**
     * @var ColumnBuilder
     */
    private ColumnBuilder $columnBuilder;

    //-------------------------------------------------
    // Ctor.
    //-------------------------------------------------

    /**
     * AbstractDatatable constructor.
     *
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
        $this->columnBuilder = new ColumnBuilder($this);
    }

    //-------------------------------------------------
    // Getter
    //-------------------------------------------------

    /**
     * @return ColumnBuilder
     */
    public function getColumnBuilder(): ColumnBuilder
    {
        return $this->columnBuilder;
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
}
