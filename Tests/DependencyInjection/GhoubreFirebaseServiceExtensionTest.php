<?php

namespace Ghoubre\FirebaseServiceBundle\Tests\DependencyInjection;

use Ghoubre\FirebaseServiceBundle\DependencyInjection\GhoubreFirebaseServiceExtension;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\Yaml\Parser;

class GhoubreFirebaseServiceExtensionTest extends TestCase
{
    protected $configuration;


    /**
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function testConfigLoadThrowsExceptionWhenNoAuthenticationRoute()
    {
        $loader = new GhoubreFirebaseServiceExtension();
        $config = $this->getEmptyConfig();
        $loader->load(array($config), new ContainerBuilder());
    }

    public function testFullConfig()
    {
        $this->configuration = new ContainerBuilder();
        $loader = new GhoubreFirebaseServiceExtension();
        $config = $this->getFullConfig();

        $loader->load(array($config), $this->configuration);

        $this->assertHasDefinition('ghoubre.firebase_notification_service');
        $this->assertEquals($this->getDefinitionArgument('ghoubre.firebase_notification_service', 0), 'serverKey');
        $this->assertEquals($this->getDefinitionArgument('ghoubre.firebase_notification_service', 1), true);
        $this->assertEquals($this->getDefinitionArgument('ghoubre.firebase_notification_service', 2), 30);
    }

    protected function getFullConfig()
    {
        $yaml = <<<EOF
serverKey: serverKey
content_available: true
time_to_live: 30
EOF;
        $parser = new Parser();
        return $parser->parse($yaml);
    }

    protected function getEmptyConfig()
    {

    }

    private function assertHasDefinition($id)
    {
        $this->assertTrue($this->configuration->hasDefinition($id));
    }

    private function getDefinitionArgument($id, $index)
    {
        return $this->configuration->getDefinition($id)->getArgument($index);
    }


}
