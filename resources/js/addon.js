import FineSeoTitle from './fieldtypes/FineSeoTitle.vue';
import FineSeoDescription from './fieldtypes/FineSeoDescription.vue';
import FineSeoPreview from './fieldtypes/FineSeoPreview.vue';
 
// Should be named [snake_case_handle]-fieldtype
Statamic.$components.register('fine_seo_title-fieldtype', FineSeoTitle);
Statamic.$components.register('fine_seo_description-fieldtype', FineSeoDescription);
Statamic.$components.register('fine_seo_preview-fieldtype', FineSeoPreview);