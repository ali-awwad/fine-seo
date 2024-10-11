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
            'fine_seo_is_title_custom' => [
                'type' => 'toggle',
                'display' => __('Custom Title'),
                // hidden field
                'visibility' => 'hidden',
                'instructions' => __('fine-seo::messages.fine_seo_is_title_custom_instructions'),
                'width' => 100,
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

    public function getBrandFields(): array
    {
        return
            [
                // title translatable
                [
                    'handle' => 'title',
                    'field' => [
                        'type' => 'text',
                        'display' => 'Title',
                        'instructions' => 'The title of the brand',
                        'localizable' => true,
                        'required' => true,
                        'width' => 50
                    ]
                ],
                // separator - select with options |, -, .
                [
                    'handle' => 'separator',
                    'field' => [
                        'type' => 'select',
                        'display' => 'Separator',
                        'instructions' => 'The separator between the title and the description',
                        'options' => [
                            '-' => '-',
                            '|' => '|',
                            '.' => '.',
                        ],
                        'default' => '-',
                        'required' => true,
                        'width' => 50
                    ]
                ],
                // logo
                [
                    'handle' => 'logo',
                    'field' => [
                        'type' => 'assets',
                        'display' => 'Logo',
                        'instructions' => 'The logo of the brand',
                        'max_files' => 1,
                        'width' => 50,
                        // 'validate' => 'null|mime_types:image/jpeg,image/png,image/svg+xml',
                        'container' => 'assets',
                        'folder' => '/brand',
                    ]
                ],
                // logo dark mode
                [
                    'handle' => 'logo_dark',
                    'field' => [
                        'type' => 'assets',
                        'display' => 'Logo Dark Mode',
                        'instructions' => 'The logo of the brand for dark mode',
                        'max_files' => 1,
                        'width' => 50,
                        // 'validate' => 'required|mime_types:image/jpeg,image/png,image/svg+xml',
                        'container' => 'assets',
                        'folder' => '/brand',
                    ]
                ],
            ];
    }
}
