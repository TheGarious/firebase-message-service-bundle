<?php

/*
 * This file is part of the Firebase Service Bundle.
 *
 * (c) Gary HOUBRE <gary.houbre@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ghoubre\FirebaseServiceBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('ghoubre_firebase_service');
        $rootNode
            ->children()
            ->scalarNode('serverKey')
            ->isRequired()
            ->cannotBeEmpty()
            ->end()
            ->scalarNode('content_available')
            ->defaultTrue()
            ->end()
            ->scalarNode('time_to_live')
            ->defaultValue(30)
            ->end()
        ;
        return $treeBuilder;
    }
}
