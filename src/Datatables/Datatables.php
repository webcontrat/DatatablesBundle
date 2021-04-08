<?php

/*
 * This file is part of the SgDatatablesBundle project.
 *
 * Copyright (c) 2021. stwe <https://github.com/stwe/DatatablesBundle>
 *
 * License: MIT
 */

namespace Sg\DatatablesBundle\Datatables;

use InvalidArgumentException;
use OutOfBoundsException;
use Sg\DatatablesBundle\Datatable\Column\ColumnInterface;
use Sg\DatatablesBundle\Datatable\DatatableInterface;
use Sg\DatatablesBundle\Datatable\Response\DatatableResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Psr\Log\LoggerInterface;

class Datatables
{
    /**
     * Inject LoggerInterface.
     *
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * An array with all Datatables.
     *
     * @var DatatableArrayObject
     */
    private DatatableArrayObject $datatables;

    //-------------------------------------------------
    // Ctor.
    //-------------------------------------------------

    /**
     * Datatables constructor.
     *
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
        $this->datatables = new DatatableArrayObject();

        $this->logger->debug('[Datatables::__construct()]: Datatables object was created.');
    }

    //-------------------------------------------------
    // Getter
    //-------------------------------------------------

    /**
     * Get all Datatable objects.
     *
     * @return DatatableArrayObject
     */
    public function getDatatables(): DatatableArrayObject
    {
        return $this->datatables;
    }

    //-------------------------------------------------
    // Array Add && Get
    //-------------------------------------------------

    /**
     * Add a Datatable.
     *
     * @param DatatableInterface $datatable
     */
    public function addDatatable(DatatableInterface $datatable): void
    {
        $id = $datatable->getId();

        if (!$this->datatables->offsetExists($id)) {

            // build table
            $datatable->buildDatatable();

            // add the given datatable to all datatables
            $this->datatables->offsetSet($id, $datatable);
            $this->logger->debug("[Datatables::addDatatable()]: Datatable with Id $id was added.");
        } else {
            throw new InvalidArgumentException("Datatable $id already exists.");
        }
    }

    /**
     * Add a Column to the correct Datatable.
     *
     * @param ColumnInterface $column
     */
    public function addColumn(ColumnInterface $column): void
    {
        // get the table by id
        $datatable = $this->getDatatableById($column->getDatatableId());

        // build column
        $column->buildColumn();

        // add the column to the datatable
        $datatable->addColumn($column);
    }

    /**
     * Get a Datatable by Id.
     *
     * @param string $id
     *
     * @return DatatableInterface
     */
    public function getDatatableById(string $id): DatatableInterface
    {
        if ($this->datatables->offsetExists($id)) {
            $this->logger->debug("[Datatables::getDatatableById()]: Returns Datatable with Id $id.");
            return $this->datatables->offsetGet($id);
        }

        throw new OutOfBoundsException("Datatable $id not found.");
    }

    //-------------------------------------------------
    // Handler
    //-------------------------------------------------

    /**
     * @param Request $request
     * @param string $id
     *
     * @return array
     */
    public function handleRequest(Request $request, string $id): array
    {
        $this->logger->info("[Datatables::handleRequest()]: Handle request with Datatable Id $id.");

        // get table
        $datatable = $this->getDatatableById($id);

        // 1) build query

        // 2) run query

        // 3) return results
        return [];
    }

    /**
     * @param array $data
     * @param string $id
     *
     * @return JsonResponse
     */
    public function handleResponse(array $data, string $id): JsonResponse
    {
        $this->logger->info("[Datatables::handleResponse()]: Handle response with Datatable Id $id.");

        // get table
        $datatable = $this->getDatatableById($id);

        // new DatatableResponse object
        $response = new DatatableResponse($datatable);

        // run renderer
        return $response->getJsonResponse($data);
    }
}
