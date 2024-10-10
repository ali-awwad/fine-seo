<?php

namespace AliAwwad\FineSeo\Actions;

use Statamic\Facades\Collection;

class GetCollectionsWithSeo
{
    public static function execute()
    {
        $collections = Collection::all();
        // map through colletions and check if fine_seo fieldset exists
        return $collections->map(function ($collection) {
            $blueprint = $collection->entryBlueprints()->first();
            $fields = $blueprint->fields();
            $collection->hasFineSeo = collect($fields->items())->contains('import', 'fine_seo');
            return $collection;
        });
    }
}