<?php

namespace Mert\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class MertUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
