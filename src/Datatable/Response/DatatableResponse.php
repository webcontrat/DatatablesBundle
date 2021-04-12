<?php

/*
 * This file is part of the SgDatatablesBundle project.
 *
 * Copyright (c) 2021. stwe <https://github.com/stwe/DatatablesBundle>
 *
 * License: MIT
 */

namespace Sg\DatatablesBundle\Datatable\Response;

use Sg\DatatablesBundle\Datatable\DatatableInterface;
use Sg\DatatablesBundle\Datatable\Renderer\RendererInterface;
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
                    $this->processRenderer($column->getDql(), $column->getRenderer(), $row);
                }
            }
        }

        return new JsonResponse($data);
    }

    /**
     * Applies the Renderer to the raw value.
     *
     * @param string $idx An index of the raw value.
     * @param RendererInterface $renderer A Renderer that changes the raw value.
     * @param array $row The raw values.
     */
    private function processRenderer(string $idx, RendererInterface $renderer, array &$row): void
    {
        $rawValue = $row[$idx];
        $newValue = $renderer->render($rawValue);
        $row[$idx] = $newValue;
    }
}
