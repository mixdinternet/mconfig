<?php

namespace Mixdinternet\Mconfig\Providers;

use Mixdinternet\Maudit\Providers\MauditServiceProvider;

class CustomMauditServiceProvider extends MauditServiceProvider
{
    public function boot()
    {
        parent::boot();
    }

    protected function setMenu()
    {

    }
}
