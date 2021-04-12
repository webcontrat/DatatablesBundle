<?php

/*
 * This file is part of the SgDatatablesBundle project.
 *
 * Copyright (c) 2021. stwe <https://github.com/stwe/DatatablesBundle>
 *
 * License: MIT
 */

namespace Sg\DatatablesBundle\Datatable\Response;

use Sg\DatatablesBundle\Datatable\Column\ColumnInterface;
use Sg\DatatablesBundle\Datatable\DatatableInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class DatatableResponse
 *
 * @package Sg\DatatablesBundle\Datatable\Response
 */
class DatatableResponse
{
    /**
     * @var DatatableInterface
     */
    private DatatableInterface $datatable;

    //-------------------------------------------------
    // Ctor.
    //-------------------------------------------------

    /**
     * DatatableResponse constructor.
     *
     * @param DatatableInterface $datatable
     */
    public function __construct(DatatableInterface $datatable)
    {
        $this->datatable = $datatable;
    }

    //-------------------------------------------------
    // Response
    //-------------------------------------------------

    /**
     * @param array $data
     *
     * @return JsonResponse
     */
    public function getJsonResponse(array $data): JsonResponse
    {
        $dataScr = $this->datatable->getAjax()->getDataSrc();

        foreach ($data[$dataScr ?? 'data'] as &$row) {
            foreach ($this->datatable->getColumns() as $column) {
                if ($column->getRenderer()) {
                    $this->processRenderer($column, $row);
                }
            }
        }

        return new JsonResponse($data);
    }

    /**
     * Applies the Renderer to the raw value.
     *
     * @param ColumnInterface $column
     * @param array $row
     */
    private function processRenderer(ColumnInterface $column, array &$row): void
    {
        $idx = $column->getDql();
        $renderer = $column->getRenderer();

        $rawValue = $row[$idx];
        $newValue = $renderer->renderColumn($column, $rawValue);
        $row[$idx] = $newValue;
    }
}
