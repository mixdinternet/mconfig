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
        $this->app->register('Mixdinternet\Mconfig\Providers\CustomMauditServiceProvider');
        $this->app->register('Mixdinternet\Mconfig\Providers\CustomMcacheServiceProvider');

        $this->setMenu();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

    }

    protected function setMenu()
    {
        Menu::modify('adminlte-sidebar', function ($menu) {
            $menu->dropdown('Configurações', function ($sub) {
                $sub->route('admin.maudit.index', 'Logs', [], 200
                    , ['icon' => 'fa fa-minus', 'active' => function () {
                        return checkActive(route('admin.maudit.index'));
                    }])->hideWhen(function () {
                    return checkRule('admin.maudit.index');
                });
                $sub->route('admin.mcache.index', 'Cache', [], 210
                    , ['icon' => 'fa fa-minus', 'active' => function () {
                        return checkActive(route('admin.mcache.index'));
                    }])->hideWhen(function () {
                    return checkRule('admin.mcache.index');
                });
            }, 2, ['icon' => 'fa fa-cogs'])->hideWhen(function(){
                return checkRule(['admin.maudit.index', 'admin.mcache.index']);
            });
        });

        Menu::modify('adminlte-permissions', function ($menu) {
            $menu->url('admin.maudit.index', 'Logs', 200, ['except' => ['create', 'edit', 'destroy', 'trash']]);
            $menu->url('admin.mcache.index', 'Cache', 210, ['except' => ['create', 'edit', 'destroy', 'trash']]);
        });
    }
}
