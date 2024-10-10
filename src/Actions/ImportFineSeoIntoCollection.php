<?php

namespace AliAwwad\FineSeo\Actions;

use Statamic\Facades\Collection;

class ImportFineSeoIntoCollection
{
    public static function execute(string $collectionHandle)
    {
        $pagesCollection = Collection::findByHandle($collectionHandle);

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
    }
}