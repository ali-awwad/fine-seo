<?php

namespace AliAwwad\FineSeo;

use AliAwwad\FineSeo\Fieldtypes\FineSeoDescription;
use AliAwwad\FineSeo\Fieldtypes\FineSeoPreview;
use AliAwwad\FineSeo\Fieldtypes\FineSeoTitle;
use Statamic\Facades\CP\Nav;
use Statamic\Providers\AddonServiceProvider;

class ServiceProvider extends AddonServiceProvider
{
    protected $vite = [
        'input' => [
            'resources/js/addon.js',
            'resources/css/addon.css',
        ],
        'publicDirectory' => 'resources/dist',
    ];

    protected $fieldtypes = [
        FineSeoTitle::class,
        FineSeoDescription::class,
        FineSeoPreview::class,
    ];

    protected $listen = [
        // \Statamic\Events\EntryBlueprintFound::class => [Listeners\AddFieldsToBlueprint::class],
    ];

    protected $routes = [
        'cp' => __DIR__.'/../routes/cp.php',
    ];

    public function bootAddon() {
        Nav::extend(function ($nav) {
            $nav->create('Fine SEO')
                ->section('Tools')
                ->route('fine-seo.index')
                ->icon('seo-search-graph')
                ;
        });
    }
}
