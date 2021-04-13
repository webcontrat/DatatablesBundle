<?php

/*
 * This file is part of the SgDatatablesBundle project.
 *
 * Copyright (c) 2021. stwe <https://github.com/stwe/DatatablesBundle>
 *
 * License: MIT
 */

namespace Sg\DatatablesBundle\Datatable\Widget;

/**
 * Class HtmlFormatWidget
 *
 * @package Sg\DatatablesBundle\Datatable\Widget
 */
class HtmlFormatWidget extends AbstractWidget
{
    /**
     * @var array
     */
    private array $tags = [];

    //-------------------------------------------------
    // Setter
    //-------------------------------------------------

    /**
     * @param string $tag
     */
    public function addTag(string $tag): void
    {
        $this->tags[] = $tag;
    }

    //-------------------------------------------------
    // Getter
    //-------------------------------------------------

    /**
     * @return array
     */
    public function getTags(): array
    {
        return $this->tags;
    }
}
