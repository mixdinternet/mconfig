<?php

namespace Mixdinternet\Mconfig\Providers;

use Mixdinternet\Mcache\Providers\McacheServiceProvider;

class CustomMcacheServiceProvider extends McacheServiceProvider
{
    public function boot()
    {
        parent::boot();
    }

    protected function setMenu()
    {

    }
}
