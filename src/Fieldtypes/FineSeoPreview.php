<?php

namespace AliAwwad\FineSeo\Fieldtypes;

use Statamic\Facades\GlobalSet;
use Statamic\Facades\Site;
use Statamic\Fields\Fieldtype;
use Statamic\Fieldtypes\Text;

class FineSeoPreview extends Fieldtype
{
    protected $type = 'text';

    private $defaultMinChars = 50;
    private $defaultMaxChars = 60;

    protected function configFieldItems(): array
    {
          return [
            'character_limit_min' => [
                'display' => __('Minimum Character Limit'),
                'instructions' => __('fine-seo::messages.fine_seo_title_character_limit_min'),
                'type' => 'integer',
                'default' => $this->defaultMinChars,
                'max' => 200,
                'width' => 50,
            ],
            'character_limit_max' => [
                'display' => __('Maximum Character Limit'),
                'instructions' => __('fine-seo::messages.fine_seo_title_character_limit_min'),
                'type' => 'integer',
                'default' => $this->defaultMaxChars,
                'max' => 200,
                'width' => 50,
            ],
          ];
    }

    
    public function defaultValue()
    {
        $parent = $this->field()->parent();
        if($parent instanceof \Statamic\Entries\Entry) {
            return $parent->get('title');
        }
        
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
        // get fields' page blueprint
        $parentPage = $this->field()?->parent();
        $maxChars = null;
        $blueprint = null;
        $site = null;
        if($parentPage && $parentPage instanceof \Statamic\Entries\Entry) {
            $blueprint = $parentPage->blueprint();
            $site = $parentPage->site();
        } else {
            return [];
        }

        if($blueprint && $blueprint instanceof \Statamic\Fields\Blueprint) {
            $descriptionField = $blueprint->fields()->get('fine_seo_description');
            if($descriptionField && $descriptionField instanceof \Statamic\Fields\Field) {
                $maxChars = $descriptionField->get('character_limit_max') ?? 160;
            }
        }

        $brand = GlobalSet::findByHandle('brand');
        $websiteTitle = null;
        $websiteSeparator = null;
        if($brand) {
            $websiteTitle = $brand->in($site->handle())->get('title');
            $websiteSeparator = $brand->in($site->handle())->get('separator');
        }
        else {
            $websiteTitle = $site->name();
            $websiteSeparator = '-';
        }

        return [
            'websiteTitle' => $websiteTitle,
            'websiteSeparator' => $websiteSeparator,
            'url' => $this->field()?->parent()?->absoluteUrl(),
            'maxChars' => $maxChars,
        ];
    }
}
