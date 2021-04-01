<?php

namespace Sg\DatatablesBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('sg_datatables');
        $rootNode = $treeBuilder->getRootNode();
        $rootNode
            ->children()
            ->booleanNode('foo')->defaultTrue()->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
