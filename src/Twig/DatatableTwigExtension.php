<?php

/*
 * This file is part of the SgDatatablesBundle project.
 *
 * Copyright (c) 2021. stwe <https://github.com/stwe/DatatablesBundle>
 *
 * License: MIT
 */

namespace Sg\DatatablesBundle\Twig;

use Sg\DatatablesBundle\Datatable\DatatableInterface;
use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class DatatableTwigExtension extends AbstractExtension
{
    //-------------------------------------------------
    // Override
    //-------------------------------------------------

    /**
     * @return TwigFunction[]
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction(
                'sg_datatables_render',
                [$this, 'datatablesRender'],
                ['is_safe' => ['html'], 'needs_environment' => true],
            ),
        ];
    }

    //-------------------------------------------------
    // Twig function
    //-------------------------------------------------

    /**
     * @param Environment $twig
     * @param DatatableInterface $datatable
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function datatablesRender(Environment $twig, DatatableInterface $datatable): string
    {
        return $twig->render(
            '@SgDatatables/datatable/datatable.html.twig',
            ['sg_datatables_view' => $datatable]
        );
    }
}
