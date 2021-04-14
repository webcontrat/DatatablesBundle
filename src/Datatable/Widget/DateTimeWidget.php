<?php

namespace Sg\DatatablesBundle\Datatable\Widget;

/**
 * Class DateTimeWidget
 *
 * @package Sg\DatatablesBundle\Datatable\Widget
 */
class DateTimeWidget extends AbstractWidget
{
    private string $format = '';

    //-------------------------------------------------
    // Getter
    //-------------------------------------------------

    /**
     * @return string
     */
    public function getFormat(): string
    {
        return $this->format;
    }

    //-------------------------------------------------
    // Setter
    //-------------------------------------------------

    /**
     * @param string $format
     */
    public function setFormat(string $format): void
    {
        $this->format = $format;
    }
}
