import FineSeoTitle from './fieldtypes/FineSeoTitle.vue';
import FineSeoDescription from './fieldtypes/FineSeoDescription.vue';
import FineSeoPreview from './fieldtypes/FineSeoPreview.vue';
import Setup from './pages/Setup.vue';

Statamic.booting(() => {
    Statamic.$components.register('fine_seo_title-fieldtype', FineSeoTitle);
    Statamic.$components.register('fine_seo_description-fieldtype', FineSeoDescription);
    Statamic.$components.register('fine_seo_preview-fieldtype', FineSeoPreview);

    Statamic.$inertia.register('fine-seo::Setup', Setup);
});