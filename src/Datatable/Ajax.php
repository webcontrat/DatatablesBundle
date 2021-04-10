<?php

/*
 * This file is part of the SgDatatablesBundle project.
 *
 * Copyright (c) 2021. stwe <https://github.com/stwe/DatatablesBundle>
 *
 * License: MIT
 */

namespace Sg\DatatablesBundle\Datatable;

use JsonSerializable;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyAccessor;

/**
 * Class Ajax
 *
 * Load data for the table's content from an Ajax source.
 *
 * @package Sg\DatatablesBundle\Datatable
 */
class Ajax implements JsonSerializable
{
    /**
     * DataTables will look for the data to use in the
     * data parameter of a returned object { "data": [...] }.
     * This can be changed by using the dataSrc option.
     * Default: null
     *
     * @var string|null
     */
    private ?string $dataSrc = null;

    /**
     * Get/set the URL that DataTables uses to Ajax fetch data.
     * Default: null
     *
     * @var string|null
     */
    private ?string $url = null;

    /**
     * Send request as POST or GET.
     * Default: null
     *
     * @var string|null
     */
    private ?string $type = null;


    // todo: add ajax.data / pipeline


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
     * Ajax constructor.
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
     * @return string|null
     */
    public function getDataSrc(): ?string
    {
        return $this->dataSrc;
    }

    /**
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    //-------------------------------------------------
    // Setter
    //-------------------------------------------------

    /**
     * @param string|null $dataSrc
     */
    public function setDataSrc(?string $dataSrc): void
    {
        $this->dataSrc = $dataSrc;
    }

    /**
     * @param string|null $url
     */
    public function setUrl(?string $url): void
    {
        $this->url = $url;
    }

    /**
     * @param string|null $type
     */
    public function setType(?string $type): void
    {
        $this->type = $type;
    }

    //-------------------------------------------------
    // Options
    //-------------------------------------------------

    /**
     * Validates the given options.
     *
     * @param OptionsResolver $resolver
     */
    private function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_src' => null,
            'url' => null,
            'type' => null,
        ]);

        $resolver->setAllowedTypes('data_src', ['null', 'string']);
        $resolver->setAllowedTypes('url', ['null', 'string']);
        $resolver->setAllowedTypes('type', ['null', 'string']);
    }

    /**
     * Options can be enabled, disabled or customised.
     *
     * @param array $options
     */
    public function set(array $options = [])
    {
        $resolver = new OptionsResolver();
        $this->configureOptions($resolver);
        $this->callingSettersWithOptions($resolver->resolve($options));
    }

    /**
     * Calls the Setter of each option.
     *
     * @param array $options
     */
    private function callingSettersWithOptions(array $options): void
    {
        foreach ($options as $setter => $value) {
            if ($this->accessor->isWritable($this, $setter)) {
                $this->accessor->setValue($this, $setter, $value);
            } else {
                // todo: exception
                return;
            }
        }
    }

    //-------------------------------------------------
    // Implement JsonSerializable
    //-------------------------------------------------

    /**
     * Specify data which should be serialized to JSON.
     *
     * @return array Data which can be serialized by <b>json_encode</b>.
     */
    public function jsonSerialize(): array
    {
        return
            [
                'data_src' => $this->getDataSrc(),
                'url' => $this->getUrl(),
                'type' => $this->getType()
            ];
    }
}
