<?php

namespace AliAwwad\FineSeo\Traits;

trait SeoFieldsTrait
{
    public function getSeoFields(): array
    {
        return [
            [
                'handle' => 'fine_seo_title',
                'field' => [
                    'type' => 'fine_seo_title',
                    'display' => __('SEO Title'),
                    'instructions' => __('fine-seo::messages.fine_seo_title_instructions'),
                    'width' => 100,
                    'localizable' => true,
                ],
            ],
            [
                'handle' => 'fine_seo_is_title_custom',
                'field' => [
                    'type' => 'toggle',
                    'display' => __('Custom Title'),
                    'visibility' => 'hidden',
                    'instructions' => __('fine-seo::messages.fine_seo_is_title_custom_instructions'),
                    'width' => 100,
                ],
            ],
            [
                'handle' => 'fine_seo_description',
                'field' => [
                    'type' => 'fine_seo_description',
                    'display' => __('SEO Description'),
                    'instructions' => __('fine-seo::messages.fine_seo_description_instructions'),
                    'localizable' => true,
                    'width' => 100,
                ],
            ],
            [
                'handle' => 'fine_seo_image',
                'field' => [
                    'type' => 'assets',
                    'display' => __('SEO Image'),
                    'instructions' => __('fine-seo::messages.fine_seo_image_instructions'),
                    'max_files' => 1,
                    'width' => 100,
                    'container' => 'assets',
                    'folder' => '/seo-images',
                ],
            ],
            [
                'handle' => 'fine_seo_preview',
                'field' => [
                    'type' => 'fine_seo_preview',
                    'display' => __('SEO Preview'),
                    'instructions' => __('fine-seo::messages.fine_seo_preview_instructions'),
                    'width' => 100,
                ],
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
                        'width' => 100
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

    public function getSeoGlobalConfigFields(): array
    {
        return
            [
                // title translatable
                [
                    'handle' => 'title',
                    'field' => [
                        'type' => 'text',
                        
                        'display' => 'Title',
                        'instructions' => 'The website title to be used. Antlers can be used to display the title such as {{ brand.title }}',
                        'instructions_position' => 'below',
                        'localizable' => true,
                        'required' => true,
                        'width' => 50,
                        'antlers' => true
                    ]
                ],
                // separator - select with options |, -, .
                [
                    'handle' => 'separator',
                    'field' => [
                        'type' => 'select',
                        'display' => 'Separator',
                        'instructions' => 'The separator between the title and the description',
                        'instructions_position' => 'below',
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
                
            ];
    }
}
