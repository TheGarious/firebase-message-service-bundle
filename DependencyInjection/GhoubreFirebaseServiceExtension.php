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

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\Config\FileLocator;

class GhoubreFirebaseServiceExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );
        $loader->load('services.xml');
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        $definition = $container->getDefinition('ghoubre.firebase_notification_service');
        $definition->replaceArgument(0, $config['serverKey']);
        $definition->replaceArgument(1, $config['content_available']);
        $definition->replaceArgument(2, $config['time_to_live']);
    }
}
