<?php

namespace AliAwwad\FineSeo\Actions;

use Statamic\Facades\Collection;

class GetCollectionsWithSeo
{
    public static function execute()
    {
        return Collection::all()->map(function ($collection) {
            $blueprint = $collection->entryBlueprints()->first();
            $collection->hasFineSeo = static::blueprintImportsFieldset($blueprint, 'fine_seo');

            return $collection;
        });
    }

    protected static function blueprintImportsFieldset($blueprint, string $fieldset): bool
    {
        foreach ($blueprint->contents()['tabs'] ?? [] as $tab) {
            foreach ($tab['sections'] ?? [] as $section) {
                foreach ($section['fields'] ?? [] as $field) {
                    if (($field['import'] ?? null) === $fieldset) {
                        return true;
                    }
                }
            }
        }

        return false;
    }
}