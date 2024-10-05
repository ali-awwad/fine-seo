<?php

namespace AliAwwad\FineSeo\Listeners;

class addFieldsToBlueprint
{

    public function handle($event)
    {
        /** @var \Statamic\Fields\Blueprint $blueprint */
        $blueprint = $event->blueprint;
        $blueprint->ensureFieldsInTab($this->getSeoFields(),'FineSEO');
    }

    protected function getSeoFields()
    {
        return [
            'fine_seo_section'=> [
                'type' => 'section',
                'display' => __('Fine SEO'),
                'instructions' => __('fine-seo::messages.fine_seo_section_instructions'),
                'listable' => 'hidden',
            ],
            'fine_seo_title' => [
                'type' => 'fine_seo_title',
                'display' => __('SEO Title'),
                'instructions' => __('fine-seo::messages.fine_seo_title_instructions'),
                'validate' => 'required',
                'width' => 100,
            ],
            'fine_seo_description' => [
                'type' => 'fine_seo_description',
                'display' => __('SEO Description'),
                'instructions' => __('fine-seo::messages.fine_seo_description_instructions'),
                'validate' => 'required',
                'width' => 100,
            ],
            'fine_seo_preview' => [
                'type' => 'fine_seo_preview',
                'display' => __('SEO Preview'),
                'instructions' => __('fine-seo::messages.fine_seo_preview_instructions'),
                'validate' => 'required',
                'width' => 100,
            ],
            'fine_seo_image' => [
                'type' => 'assets',
                'display' => __('SEO Image'),
                'instructions' => __('fine-seo::messages.fine_seo_image_instructions'),
                'max_files' => 1,
                'width' => 100,
                'container' => 'assets',
                'folder' => '/my-images',
            ],
        ];
    }
}