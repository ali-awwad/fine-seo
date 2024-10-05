<?php

namespace AliAwwad\FineSeo\Traits;

trait SeoFieldsTrait
{
    public function getSeoFields()
    {
        return [
            'fine_seo_title' => [
                'type' => 'fine_seo_title',
                'display' => __('SEO Title'),
                'instructions' => __('fine-seo::messages.fine_seo_title_instructions'),
                'width' => 100,
                'localizable' => true,
            ],
            'fine_seo_description' => [
                'type' => 'fine_seo_description',
                'display' => __('SEO Description'),
                'instructions' => __('fine-seo::messages.fine_seo_description_instructions'),
                'localizable' => true,
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
            'fine_seo_preview' => [
                'type' => 'fine_seo_preview',
                'display' => __('SEO Preview'),
                'instructions' => __('fine-seo::messages.fine_seo_preview_instructions'),
                'width' => 100,
            ],
        ];
    }
}