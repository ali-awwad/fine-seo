<template>
    <div>
        <ui-input-group>
            <ui-input
                :model-value="value ?? publishContainer.values.title"
                @update:model-value="updateDebounced"
            />
            <ui-input-group-append v-if="!publishContainer.values.fine_seo_is_title_custom">
                {{ meta.websiteTitle ?? 'Website Title' }}
            </ui-input-group-append>
            <ui-input-group-append>
                <ui-switch
                    :model-value="publishContainer.values.fine_seo_is_title_custom"
                    @update:model-value="updateIsCustomField"
                    size="sm"
                    v-tooltip="__('fine-seo::messages.customize_page_title')"
                />
            </ui-input-group-append>
        </ui-input-group>
        <ProgressBar :value="valueWithWebsiteTitle" :minChars="meta.minChars" :maxChars="meta.maxChars" />
        <p v-if="publishContainer.values.fine_seo_is_title_custom" class="text-sm text-gray-600 mt-2">
            {{ __('fine-seo::messages.customize_page_title_long_description') }}
        </p>
    </div>
</template>

<script>
import { FieldtypeMixin as Fieldtype } from '@statamic/cms';
import ProgressBar from '../components/ProgressBar.vue';

export default {
    components: {
        ProgressBar,
    },

    mixins: [Fieldtype],

    computed: {
        formValues() {
            return this.publishContainer.values;
        },
        title() {
            return this.formValues.title ?? this.value;
        },
        valueWithWebsiteTitle() {
            return (this.meta.websiteTitle && !this.formValues.fine_seo_is_title_custom)
                ? this.meta.websiteTitle + ' ' + this.value
                : this.value;
        },
    },

    methods: {
        updateIsCustomField(newValue) {
            this.publishContainer.setFieldValue('fine_seo_is_title_custom', newValue);
        },
    },
};
</script>
