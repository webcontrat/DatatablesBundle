<?php

/*
 * This file is part of the SgDatatablesBundle package.
 *
 * (c) stwe <https://github.com/stwe/DatatablesBundle>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sg\DatatablesBundle\Datatable\Extension;

use Sg\DatatablesBundle\Datatable\OptionsTrait;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Scroller
{
    use OptionsTrait;

    //-------------------------------------------------
    // DataTables - Scroller Extension
    //-------------------------------------------------

    /**
     * The boundary scale to use.
     *
     * @var float|null
     */
    protected $boundaryScale;

    /**
     * The display buffer to use.
     *
     * @var int|null
     */
    protected $displayBuffer;
    
    /**
     * Display a loading message while Scroller is loading additional data.
     *
     * @var bool|null
     */
    protected $loadingIndicator;

    /**
     * Row height - pixels
     * Default: auto
     * 
     * @var int|null
     */
    protected $rowHeight;

    /**
     * Time to wait before loading additional data after scrolling ends.
     * In milliseconds.
     *
     * @var int|null
     */
    protected $serverWait;


    public function __construct()
    {
        $this->initOptions();
    }

    //-------------------------------------------------
    // Options
    //-------------------------------------------------

    /**
     * @return $this
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'boundary_scale' => null,
                'display_buffer' => null,
                'loading_indicator' => null,
                'row_height' => null,
                'server_wait' => null,
            ]
        );
        
        $resolver->setDefined('boundary_scale');
        $resolver->setDefined('display_buffer');
        $resolver->setDefined('loading_indicator');
        $resolver->setDefined('row_height');
        $resolver->setDefined('server_wait');

        $resolver->setAllowedTypes('boundary_scale', ['int', 'null']);
        $resolver->setAllowedTypes('display_buffer', ['int', 'null']);
        $resolver->setAllowedTypes('loading_indicator', ['bool', 'null']);
        $resolver->setAllowedTypes('row_height', ['int', 'null']);
        $resolver->setAllowedTypes('server_wait', ['int', 'null']);
        
        return $this;
    }

    //-------------------------------------------------
    // Getters && Setters
    //-------------------------------------------------

    /**
     * @return float|null
     */
    public function getBoundaryScale()
    {
        return $this->boundaryScale;
    }

    /**
     * @param float|null $boundaryScale
     *
     * @return $this
     */
    public function setBoundaryScale($boundaryScale): Scroller
    {
        $this->boundaryScale = $boundaryScale;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getDisplayBuffer()
    {
        return $this->displayBuffer;
    }

    /**
     * @param int|null $displayBuffer
     *
     * @return $this
     */
    public function setDisplayBuffer($displayBuffer): Scroller
    {
        $this->displayBuffer = $displayBuffer;
        
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getLoadingIndicator()
    {
        return $this->loadingIndicator;
    }

    /**
     * @param bool|null $loadingIndicator
     *
     * @return $this
     */
    public function setLoadingIndicator($loadingIndicator): Scroller
    {
        $this->loadingIndicator = $loadingIndicator;
        
        return $this;
    }

    /**
     * @return int|null
     */
    public function getRowHeight()
    {
        return $this->rowHeight;
    }

    /**
     * @param int|null $rowHeight
     *
     * @return $this
     */
    public function setRowHeight($rowHeight): Scroller
    {
        $this->rowHeight = $rowHeight;
        
        return $this;
    }

    /**
     * @return int|null
     */
    public function getServerWait()
    {
        return $this->serverWait;
    }

    /**
     * @param int|null $serverWait
     * 
     * @return $this
     */
    public function setServerWait($serverWait): Scroller
    {
        $this->serverWait = $serverWait;
        
        return $this;
    }

}
