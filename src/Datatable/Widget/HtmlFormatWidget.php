<?php

/*
 * This file is part of the SgDatatablesBundle project.
 *
 * Copyright (c) 2021. stwe <https://github.com/stwe/DatatablesBundle>
 *
 * License: MIT
 */

namespace Sg\DatatablesBundle\Datatable\Widget;

class HtmlFormatWidget extends AbstractWidget
{
    /**
     * @var bool
     */
    private bool $bold = false;

    /**
     * @var bool
     */
    private bool $italic = false;

    //-------------------------------------------------
    // Getter
    //-------------------------------------------------

    /**
     * @return bool
     */
    public function isBold(): bool
    {
        return $this->bold;
    }

    /**
     * @return bool
     */
    public function isItalic(): bool
    {
        return $this->italic;
    }

    //-------------------------------------------------
    // Setter
    //-------------------------------------------------

    /**
     * @param bool $bold
     */
    public function setBold(bool $bold): void
    {
        $this->bold = $bold;
    }

    /**
     * @param bool $italic
     */
    public function setItalic(bool $italic): void
    {
        $this->italic = $italic;
    }
}
