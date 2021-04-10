<?php

/*
 * This file is part of the SgDatatablesBundle project.
 *
 * Copyright (c) 2021. stwe <https://github.com/stwe/DatatablesBundle>
 *
 * License: MIT
 */

namespace Sg\DatatablesBundle\Datatable;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyAccessor;

/**
 * Class Features
 *
 * Features can be enabled, disabled or customised to meet your exact needs for your table implementations.
 *
 * @package Sg\DatatablesBundle\Datatable
 */
class Features
{
    /**
     * Feature control DataTables' smart column width handling.
     * DataTables default: true
     *
     * @var bool
     */
    private bool $autoWidth = true;

    /**
     * Feature control deferred rendering for additional speed of initialisation.
     * DataTables default: false
     *
     * @var bool
     */
    private bool $deferRender = false;

    /**
     * Feature control table information display field.
     * DataTables default: true
     *
     * @var bool
     */
    private bool $info = true;

    /**
     * Feature control the end user's ability to change the paging display length of the table.
     * DataTables default: true
     *
     * @var bool
     */
    private bool $lengthChange = true;

    /**
     * Feature control ordering (sorting) abilities in DataTables.
     * DataTables default: true
     *
     * @var bool
     */
    private bool $ordering = true;

    /**
     * Enable or disable table pagination.
     * DataTables default: true
     *
     * @var bool
     */
    private bool $paging = true;

    /**
     * Feature control the processing indicator.
     * DataTables default: false
     *
     * @var bool
     */
    private bool $processing = false;

    /**
     * Horizontal scrolling.
     * DataTables default: false
     *
     * @var bool
     */
    private bool $scrollX = false;

    /**
     * Vertical scrolling.
     * DataTables default value is: '' (empty string)
     *
     * @var string
     */
    private string $scrollY = '';

    /**
     * Feature control search (filtering) abilities.
     * DataTables default: true
     *
     * @var bool
     */
    private bool $searching = true;

    /**
     * Feature control DataTables' server-side processing mode.
     * By default DataTables operates in client-side processing mode,
     * but can be switched to server-side processing mode using this option.
     * DataTables default: false
     *
     * @var bool
     */
    private bool $serverSide = false;

    /**
     * State saving - restore table state on page reload.
     * DataTables default: false
     *
     * @var bool
     */
    private bool $stateSave = false;

    /**
     * The PropertyAccessor.
     *
     * @var PropertyAccessor
     */
    private PropertyAccessor $accessor;

    //-------------------------------------------------
    // Ctor.
    //-------------------------------------------------

    /**
     * Features constructor.
     */
    public function __construct()
    {
        $this->accessor = PropertyAccess::createPropertyAccessorBuilder()
            ->enableMagicCall()
            ->getPropertyAccessor()
        ;
    }

    //-------------------------------------------------
    // Getter
    //-------------------------------------------------

    /**
     * @return bool
     */
    public function isAutoWidth(): bool
    {
        return $this->autoWidth;
    }

    /**
     * @return bool
     */
    public function isDeferRender(): bool
    {
        return $this->deferRender;
    }

    /**
     * @return bool
     */
    public function isInfo(): bool
    {
        return $this->info;
    }

    /**
     * @return bool
     */
    public function isLengthChange(): bool
    {
        return $this->lengthChange;
    }

    /**
     * @return bool
     */
    public function isOrdering(): bool
    {
        return $this->ordering;
    }

    /**
     * @return bool
     */
    public function isPaging(): bool
    {
        return $this->paging;
    }

    /**
     * @return bool
     */
    public function isProcessing(): bool
    {
        return $this->processing;
    }

    /**
     * @return bool
     */
    public function isScrollX(): bool
    {
        return $this->scrollX;
    }

    /**
     * @return string
     */
    public function getScrollY(): string
    {
        return $this->scrollY;
    }

    /**
     * @return bool
     */
    public function isSearching(): bool
    {
        return $this->searching;
    }

    /**
     * @return bool
     */
    public function isServerSide(): bool
    {
        return $this->serverSide;
    }

    /**
     * @return bool
     */
    public function isStateSave(): bool
    {
        return $this->stateSave;
    }

    //-------------------------------------------------
    // Setter
    //-------------------------------------------------

    /**
     * @param bool $autoWidth
     */
    public function setAutoWidth(bool $autoWidth): void
    {
        $this->autoWidth = $autoWidth;
    }

    /**
     * @param bool $deferRender
     */
    public function setDeferRender(bool $deferRender): void
    {
        $this->deferRender = $deferRender;
    }

    /**
     * @param bool $info
     */
    public function setInfo(bool $info): void
    {
        $this->info = $info;
    }

    /**
     * @param bool $lengthChange
     */
    public function setLengthChange(bool $lengthChange): void
    {
        $this->lengthChange = $lengthChange;
    }

    /**
     * @param bool $ordering
     */
    public function setOrdering(bool $ordering): void
    {
        $this->ordering = $ordering;
    }

    /**
     * @param bool $paging
     */
    public function setPaging(bool $paging): void
    {
        $this->paging = $paging;
    }

    /**
     * @param bool $processing
     */
    public function setProcessing(bool $processing): void
    {
        $this->processing = $processing;
    }

    /**
     * @param bool $scrollX
     */
    public function setScrollX(bool $scrollX): void
    {
        $this->scrollX = $scrollX;
    }

    /**
     * @param string $scrollY
     */
    public function setScrollY(string $scrollY): void
    {
        $this->scrollY = $scrollY;
    }

    /**
     * @param bool $searching
     */
    public function setSearching(bool $searching): void
    {
        $this->searching = $searching;
    }

    /**
     * @param bool $serverSide
     */
    public function setServerSide(bool $serverSide): void
    {
        $this->serverSide = $serverSide;
    }

    /**
     * @param bool $stateSave
     */
    public function setStateSave(bool $stateSave): void
    {
        $this->stateSave = $stateSave;
    }

    //-------------------------------------------------
    // Options
    //-------------------------------------------------

    /**
     * Validates the given features.
     *
     * @param OptionsResolver $resolver
     */
    private function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'auto_width' => true,
            'defer_render' => false,
            'info' => true,
            'length_change' => true,
            'ordering' => true,
            'paging' => true,
            'processing' => false,
            'scroll_x' => false,
            'scroll_y' => '',
            'searching' => true,
            'server_side' => false,
            'state_save' => false,
        ]);

        $resolver->setAllowedTypes('auto_width', ['bool']);
        $resolver->setAllowedTypes('defer_render', ['bool']);
        $resolver->setAllowedTypes('info', ['bool']);
        $resolver->setAllowedTypes('length_change', ['bool']);
        $resolver->setAllowedTypes('ordering', ['bool']);
        $resolver->setAllowedTypes('paging', ['bool']);
        $resolver->setAllowedTypes('processing', ['bool']);
        $resolver->setAllowedTypes('scroll_x', ['bool']);
        $resolver->setAllowedTypes('scroll_y', ['string']);
        $resolver->setAllowedTypes('searching', ['bool']);
        $resolver->setAllowedTypes('server_side', ['bool']);
        $resolver->setAllowedTypes('state_save', ['bool']);
    }

    /**
     * Features can be enabled, disabled or customised.
     *
     * @param array $features
     */
    public function set(array $features = [])
    {
        $resolver = new OptionsResolver();
        $this->configureOptions($resolver);
        $this->callingSettersWithOptions($resolver->resolve($features));
    }

    /**
     * Calls the Setter of each Feature.
     *
     * @param array $features
     */
    private function callingSettersWithOptions(array $features): void
    {
        foreach ($features as $setter => $value) {
            if ($this->accessor->isWritable($this, $setter)) {
                $this->accessor->setValue($this, $setter, $value);
            } else {
                // todo: exception
                return;
            }
        }
    }
}
