<?php

namespace ghoubre\FirebaseServiceBundle;

use ghoubre\FirebaseServiceBundle\DependencyInjection\ghoubreFirebaseServiceExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class ghoubreFirebaseServiceBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new ghoubreFirebaseServiceExtension();
    }
}
