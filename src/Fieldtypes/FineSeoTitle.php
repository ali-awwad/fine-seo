<?php

namespace AliAwwad\FineSeo\Fieldtypes;

use Statamic\Facades\GlobalSet;
use Statamic\Facades\Site;
use Statamic\Fields\Fieldtype;
use Statamic\Fieldtypes\Text;

class FineSeoTitle extends Fieldtype
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
        $parentPage = $this->field->parent();
        /** @var \Statamic\Entries\Site|null $site */
        $site = null;
        $defaultTitle = null;
        if($parentPage instanceof \Statamic\Entries\Entry) {
            $site = $parentPage->site();
            $defaultTitle = $parentPage->get('title');
        } else {
            $site = Site::current();
        }
        
     
        $brand = GlobalSet::findByHandle('brand');
        $websiteTitle = null;
        if($brand) {
            $websiteTitle = $brand->in($site->handle())->get('title');
        }
        else {
            $websiteTitle = $site->name();
        }
        return [
            'pageTitle' => $defaultTitle,
            'websiteTitle' => $websiteTitle,
            'maxChars' => $this->field()->get('character_limit_max') ?? $this->defaultMaxChars,
            'minChars' => $this->field()->get('character_limit_min') ?? $this->defaultMinChars,
        ];
    }
}
