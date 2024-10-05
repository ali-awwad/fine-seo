<?php

namespace AliAwwad\FineSeo\Fieldtypes;

use Statamic\Facades\GlobalSet;
use Statamic\Fields\Fieldtype;
use Statamic\Fieldtypes\Text;

class FineSeoDescription extends Fieldtype
{
    protected $type = 'text';

    private $defaultMinChars = 150;
    private $defaultMaxChars = 160;

    protected function configFieldItems(): array
    {
        return [
            'character_limit_min' => [
                'display' => __('Minimum Character Limit'),
                'instructions' => __('fine-seo::messages.fine_seo_title_character_limit_min'),
                'type' => 'integer',
                'default' => $this->defaultMinChars,
                'max' => 300,
                'width' => 100,
            ],
            'character_limit_max' => [
                'display' => __('Maximum Character Limit'),
                'instructions' => __('fine-seo::messages.fine_seo_title_character_limit_min'),
                'type' => 'integer',
                'default' => $this->defaultMaxChars,
                'max' => 300,
                'width' => 100,
            ],
        ];
    }


    public function defaultValue()
    {
        return null;
    }


    public function preProcess($data)
    {
        return $data;
    }


    public function process($data)
    {
        return $data;
    }

    public function preload()
    {
        return [
            'maxChars' => $this->field()->get('character_limit_max') ?? $this->defaultMaxChars,
            'minChars' => $this->field()->get('character_limit_min') ?? $this->defaultMinChars,
        ];
    }
}
