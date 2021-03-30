<?php

/*
 * This file is part of the SgDatatablesBundle project.
 *
 * Copyright (c) 2021. stwe <https://github.com/stwe/DatatablesBundle>
 *
 * License: MIT
 */

namespace Sg\DatatablesBundle\Datatable;

use Twig\Environment;

interface DatatableInterface
{
    public function buildDatatable(array $options = []): void;
    public function getTwig(): Environment;
}
