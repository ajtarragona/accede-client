<?php

namespace Ajtarragona\AccedeTercers\Facades; 

use Illuminate\Support\Facades\Facade;

class AccedeTercers extends Facade
{
    /**
     * {@inheritdoc}
     */
    protected static function getFacadeAccessor()
    {
        return 'accedetercers';
    }
}
