<?php

/*
 * This file is part of the SgDatatablesBundle project.
 *
 * Copyright (c) 2021. stwe <https://github.com/stwe/DatatablesBundle>
 *
 * License: MIT
 */

namespace Sg\DatatablesBundle\DependencyInjection;

use Exception;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\Reference;

class SgDatatablesExtension extends Extension implements CompilerPassInterface
{
    //-------------------------------------------------
    // Override
    //-------------------------------------------------

    /**
     * Loads a specific configuration.
     *
     * @param array $configs
     * @param ContainerBuilder $container
     *
     * @throws Exception
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );
        $loader->load('services.xml');

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
    }

    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        $definition = $container->findDefinition('sg_datatables.datatables.datatables');

        // datatable services
        $datatableServices = $container->findTaggedServiceIds('sg_datatable');

        // column services
        $columnServices = $container->findTaggedServiceIds('sg_datatable_column');

        // add datatables
        foreach ($datatableServices as $key => $value) {
            $definition->addMethodCall('addDatatable', [
                new Reference($key)
            ]);
        }

        // add columns to datatables
        foreach ($columnServices as $key => $value) {
            $definition->addMethodCall('addColumn', [
                new Reference($key)
            ]);
        }
    }
}
