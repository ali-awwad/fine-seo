<?php

namespace AliAwwad\FineSeo\Http\Controllers;

use AliAwwad\FineSeo\Traits\SeoFieldsTrait;
use Statamic\Facades\Collection;
use Statamic\Facades\CP\Toast;
use Statamic\Facades\Fieldset;

class SeoFieldsController
{
    use SeoFieldsTrait;


    public function index()
    {
        return view('fine-seo::index');
    }

    public function setup()
    {

        $fieldset = Fieldset::make('fine_seo');
        $fieldset->title('Fine SEO');
        $fieldset->setContents([
            'fields' => $this->getSeoFields()
        ]);
        $fieldset->save();

        $pagesCollection = Collection::findByHandle('pages');

        // add the fieldset to the blueprint
        /** @var \Statamic\Fields\Blueprint $blueprint */
        $blueprint = $pagesCollection->entryBlueprints()->first();

        // array of fields
        // as tabs > tabName > sections > section# > fields > field#
        $blueprintContents = $blueprint->contents();

        $blueprintContents['tabs']['fineSeo'] = [
            'display' => 'Fine SEO',
            'sections' => [
                [
                    'display' => 'Fine SEO',
                    'instructions' => __('fine-seo::messages.fine_seo_section_instructions'),
                    'fields' => [
                        ['import' => 'fine_seo']
                    ]
                ],
            ]
        ];

        $blueprint->setContents($blueprintContents);

        // Save the updated blueprint
        $blueprint->save();


        Toast::success('SEO fields have been setup!');
        return redirect()->cpRoute('fine-seo.index');
    }
}
