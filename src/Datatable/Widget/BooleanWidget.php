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
 * Class BooleanWidget
 *
 * @package Sg\DatatablesBundle\Datatable\Widget
 */
class BooleanWidget extends AbstractWidget
{
    /**
     * The label for a value that is true.
     *
     * @var string
     */
    private string $trueLabel = 'true';

    /**
     * The label for a value that is false.
     *
     * @var string
     */
    private string $falseLabel = 'false';

    /**
     * The icon for a value that is true.
     *
     * @var string
     */
    private string $trueIcon = '';

    /**
     * The icon for a value that is false.
     *
     * @var string
     */
    private string $falseIcon = '';

    /**
     * Prefer icons for rendering.
     *
     * @var bool
     */
    private bool $preferIcons = false;

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

    /**
     * @return string
     */
    public function getTrueIcon(): string
    {
        return $this->trueIcon;
    }

    /**
     * @return string
     */
    public function getFalseIcon(): string
    {
        return $this->falseIcon;
    }

    /**
     * @return bool
     */
    public function isPreferIcons(): bool
    {
        return $this->preferIcons;
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

    /**
     * @param string $trueIcon
     */
    public function setTrueIcon(string $trueIcon): void
    {
        $this->trueIcon = $trueIcon;
    }

    /**
     * @param string $falseIcon
     */
    public function setFalseIcon(string $falseIcon): void
    {
        $this->falseIcon = $falseIcon;
    }

    /**
     * @param bool $preferIcons
     */
    public function setPreferIcons(bool $preferIcons): void
    {
        $this->preferIcons = $preferIcons;
    }
}
