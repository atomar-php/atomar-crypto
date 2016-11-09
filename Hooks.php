<?php

namespace crypto;

use atomar\core\HookReceiver;

class Hooks extends HookReceiver
{
    function hookLibraries()
    {
        return array (
            'Crypt.php'
        );
    }
}