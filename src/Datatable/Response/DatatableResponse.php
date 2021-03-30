<?php

/*
 * This file is part of the SgDatatablesBundle project.
 *
 * Copyright (c) 2021. stwe <https://github.com/stwe/DatatablesBundle>
 *
 * License: MIT
 */

namespace Sg\DatatablesBundle\Datatable\Response;

use Sg\DatatablesBundle\Datatable\Column\Column;
use Sg\DatatablesBundle\Datatable\DatatableInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

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
     * @return JsonResponse
     */
    public function getJsonResponse(): JsonResponse
    {
        $data =
            [
                'data' =>
                    [
                        [
                            'name' => 'Tiger',
                            'position' => false
                        ],
                        [
                            'name' => '',
                            'position' => 'Worker'
                        ]
                    ]
            ];

        foreach ($data['data'] as &$row) {
            foreach ($this->datatable->getColumnBuilder()->getColumns() as $column) {
                $idx = $column->getDql();

                $rawValue = $row[$idx];

                /**
                 * @var Column $column
                 */
                $newValue = $column->getRenderer()->render($rawValue);
                $row[$idx] = $newValue;
            }
        }

        return new JsonResponse($data);
    }
}
