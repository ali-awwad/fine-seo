<?php

namespace AliAwwad\FineSeo\Http\Controllers;

use AliAwwad\FineSeo\Actions\GetCollectionsWithSeo;
use AliAwwad\FineSeo\Actions\ImportFineSeoIntoCollection;
use AliAwwad\FineSeo\Traits\SeoFieldsTrait;
use Statamic\Facades\Collection;
use Statamic\Facades\CP\Toast;
use Statamic\Facades\Fieldset;
use Illuminate\Http\Request;
use Statamic\Facades\Blueprint;
use Statamic\Facades\GlobalSet;
use Statamic\Facades\Site;

class SeoFieldsController
{
    use SeoFieldsTrait;

    public function index()
    {
        return view('fine-seo::index', [
            'title' => 'SEO Fields Setup',
            'collections' => GetCollectionsWithSeo::execute()
        ]);
    }

    public function brand(Request $request)
    {
        $global = GlobalSet::make('brand')->title('Brand');
        foreach (Site::all() as $site) {
            $global->addLocalization($global->makeLocalization($site->handle()));
        }
        $global->save();
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
            if (!in_array($collection->handle, ($request->collections ?? []))) {

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
