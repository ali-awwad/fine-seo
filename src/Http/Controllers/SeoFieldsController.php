<?php

namespace AliAwwad\FineSeo\Http\Controllers;

use AliAwwad\FineSeo\Actions\GetCollectionsWithSeo;
use AliAwwad\FineSeo\Actions\ImportFineSeoIntoCollection;
use AliAwwad\FineSeo\Traits\SeoFieldsTrait;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Statamic\Facades\Blueprint;
use Statamic\Facades\Collection;
use Statamic\Facades\CP\Toast;
use Statamic\Facades\Fieldset;
use Statamic\Facades\GlobalSet;
use Statamic\Facades\Site;

class SeoFieldsController
{
    use SeoFieldsTrait;

    public function index()
    {
        $collections = GetCollectionsWithSeo::execute()->map(fn ($collection) => [
            'handle' => $collection->handle(),
            'title' => $collection->title(),
            'hasFineSeo' => $collection->hasFineSeo,
        ])->values();

        return Inertia::render('fine-seo::Setup', [
            'title' => __('fine-seo::messages.seo_title'),
            'collections' => $collections,
        ]);
    }

    /**
     * Add Global Fine SEO Config
     */
    public function configGlobal(Request $request)
    {
        $global = GlobalSet::make('fine_seo_config')->title('Fine SEO Config');
        $global->save();

        foreach (Site::all() as $site) {
            $global->in($site->handle())->data([])->save();
        }
        $blueprint = Blueprint::make('fine_seo_config')->setNamespace('globals');
        $blueprint->setContents([
            'tabs' => [
                'main' => [
                    'sections' => [
                        [
                            'display' => 'Config',
                            'instructions' => 'SEO Config settings',
                            'fields' => $this->getSeoGlobalConfigFields()
                        ]
                    ]
                ]
            ]
        ]);

        $blueprint->save();

        Toast::success('Fine SEO Config fields have been setup!');
        return redirect()->cpRoute('fine-seo.index');
    }
    public function brand(Request $request)
    {
        $global = GlobalSet::make('brand')->title('Brand');
        $global->save();

        foreach (Site::all() as $site) {
            $global->in($site->handle())->data([])->save();
        }
        $blueprint = Blueprint::make('brand')->setNamespace('globals');
        $blueprint->setContents([
            'tabs' => [
                'main' => [
                    'sections' => [
                        [
                            'display' => 'Brand',
                            'instructions' => 'Brand settings',
                            'fields' => $this->getBrandFields()
                        ]
                    ]
                ]
            ]
        ]);

        $blueprint->save();

        Toast::success('Brand fields have been setup!');
        return redirect()->cpRoute('fine-seo.index');
    }

    public function setup(Request $request)
    {
        $request->validate([
            'collections' => 'nullable|array'
        ]);

        // save seo fields as a fieldset
        $fieldset = Fieldset::make('fine_seo');
        $fieldset->title('Fine SEO');
        $fieldset->setContents([
            'fields' => $this->getSeoFields()
        ]);
        $fieldset->save();

        $alreadyImported = GetCollectionsWithSeo::execute()->filter(function ($collection) {
            return $collection->hasFineSeo;
        });

        // unset the fieldset from collections that already have it but not in the selected collections
        foreach ($alreadyImported as $collection) {
            if (!in_array($collection->handle(), ($request->collections ?? []))) {

                /** @var \Statamic\Fields\Blueprint $blueprint */
                $blueprint = $collection->entryBlueprints()->first();
                $blueprint->removeTab('fineSeo');
                $blueprint->save();
            }
        }

        // Import the fieldset into the selected collections
        foreach (($request->collections ?? []) as $key => $collectionHandle) {
            ImportFineSeoIntoCollection::execute($collectionHandle);
        }


        Toast::success('SEO fields have been setup!');
        return redirect()->cpRoute('fine-seo.index');
    }
}
