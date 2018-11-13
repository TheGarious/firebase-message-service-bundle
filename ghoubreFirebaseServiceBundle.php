<?php

namespace Ghoubre\FirebaseServiceBundle;

use Ghoubre\FirebaseServiceBundle\DependencyInjection\GhoubreFirebaseServiceExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class GhoubreFirebaseServiceBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new GhoubreFirebaseServiceExtension();
    }
}
