<?php

/*
 * This file is part of the Firebase Service Bundle.
 *
 * (c) Gary HOUBRE <gary.houbre@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ghoubre\FirebaseServiceBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\Config\FileLocator;

class ghoubreFirebaseServiceExtension extends Extension
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
        $definition = $container->getDefinition('ghoubre\FirebaseServiceBundle\Service\FirebaseNotificationService');
        $definition->replaceArgument(0, $config['serverKey']);
        $definition->replaceArgument(1, $config['content_available']);
        $definition->replaceArgument(2, $config['time_to_live']);
    }
}
