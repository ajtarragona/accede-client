<?php

namespace Ajtarragona\Accede\Facades; 

use Illuminate\Support\Facades\Facade;

class Firmadoc extends Facade
{
    /**
     * {@inheritdoc}
     */
    protected static function getFacadeAccessor()
    {
        return 'firmadoc';
    }
}
