<?php

/*
 * This file is part of the SgDatatablesBundle project.
 *
 * Copyright (c) 2021. stwe <https://github.com/stwe/DatatablesBundle>
 *
 * License: MIT
 */

namespace Sg\DatatablesBundle\Datatable\Widget;

use ArrayObject;
use InvalidArgumentException;

class WidgetArrayObject extends ArrayObject
{
    //-------------------------------------------------
    // Override
    //-------------------------------------------------

    /**
     * WidgetArrayObject constructor.
     *
     * @param WidgetInterface ...$widgets
     */
    public function __construct(WidgetInterface ...$widgets)
    {
        parent::__construct($widgets);

        $this->setIteratorClass(WidgetArrayIterator::class);
    }

    /**
     * @param mixed $key
     * @param mixed $value
     */
    public function offsetSet($key, $value): void
    {
        if ($value instanceof WidgetInterface) {
            parent::offsetSet($key, $value);
        } else {
            throw new InvalidArgumentException('Value must be a WidgetInterface.');
        }
    }
}
