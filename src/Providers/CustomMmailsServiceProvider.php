<?php

namespace Mixdinternet\Mconfig\Providers;

use Mixdinternet\Mmails\Providers\MmailsServiceProvider;

class CustomMmailsServiceProvider extends MmailsServiceProvider
{
    public function boot()
    {
        parent::boot();
    }

    protected function setMenu()
    {

    }
}
