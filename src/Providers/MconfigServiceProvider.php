<?php

namespace Mixdinternet\Mconfig\Providers;

use Illuminate\Support\ServiceProvider;

use Menu;

class MconfigServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->setMenu();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register('Mixdinternet\Mconfig\Providers\CustomMauditServiceProvider');
        $this->app->register('Mixdinternet\Mconfig\Providers\CustomMcacheServiceProvider');
        $this->app->register('Mixdinternet\Mconfig\Providers\CustomMmailsServiceProvider');
    }

    protected function setMenu()
    {
        Menu::modify('adminlte-sidebar', function ($menu) {
            $menu->dropdown('Configurações', function ($sub) {
                $sub->route('admin.mmails.index', 'Formulários', [], 200
                    , ['icon' => 'fa fa-minus', 'active' => function () {
                        return checkActive(route('admin.mmails.index'));
                    }])->hideWhen(function () {
                    return checkRule('admin.mmails.index');
                });
                $sub->route('admin.maudit.index', 'Logs', [], 210
                    , ['icon' => 'fa fa-minus', 'active' => function () {
                        return checkActive(route('admin.maudit.index'));
                    }])->hideWhen(function () {
                    return checkRule('admin.maudit.index');
                });
                $sub->route('admin.mcache.index', 'Cache', [], 220
                    , ['icon' => 'fa fa-minus', 'active' => function () {
                        return checkActive(route('admin.mcache.index'));
                    }])->hideWhen(function () {
                    return checkRule('admin.mcache.index');
                });
            }, 2, ['icon' => 'fa fa-cogs'])->hideWhen(function(){
                return checkRule(['admin.maudit.index', 'admin.mcache.index', 'admin.mmails.index']);
            });
        });

        Menu::modify('adminlte-permissions', function ($menu) {
            $menu->url('admin.mmails.index', 'Formulários', 200);
            $menu->url('admin.maudit.index', 'Logs', 210, ['except' => ['create', 'edit', 'destroy', 'trash']]);
            $menu->url('admin.mcache.index', 'Cache', 220, ['except' => ['create', 'edit', 'destroy', 'trash']]);
        });
    }
}
