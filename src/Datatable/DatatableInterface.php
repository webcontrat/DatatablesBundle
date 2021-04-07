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

interface DatatableInterface
{
    public function buildDatatable(): void;
    public function getId(): string;

    public function getTwig(): Environment;
    public function getRouter(): UrlGeneratorInterface;
    public function getColumnBuilder(): ColumnBuilder;
    public function getAjax(): array;
    public function setAjax(array $options): void;
}
