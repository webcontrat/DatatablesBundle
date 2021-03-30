<?php

/*
 * This file is part of the SgDatatablesBundle project.
 *
 * Copyright (c) 2021. stwe <https://github.com/stwe/DatatablesBundle>
 *
 * License: MIT
 */

namespace Sg\DatatablesBundle\Datatable\Widget;

class BooleanWidget extends AbstractWidget
{
    /**
     * @var string
     */
    private string $trueLabel = 'True';

    /**
     * @var string
     */
    private string $falseLabel = 'False';

    //-------------------------------------------------
    // Getter
    //-------------------------------------------------

    /**
     * @return string
     */
    public function getTrueLabel(): string
    {
        return $this->trueLabel;
    }

    /**
     * @return string
     */
    public function getFalseLabel(): string
    {
        return $this->falseLabel;
    }

    //-------------------------------------------------
    // Setter
    //-------------------------------------------------

    /**
     * @param string $trueLabel
     */
    public function setTrueLabel(string $trueLabel): void
    {
        $this->trueLabel = $trueLabel;
    }

    /**
     * @param string $falseLabel
     */
    public function setFalseLabel(string $falseLabel): void
    {
        $this->falseLabel = $falseLabel;
    }
}
