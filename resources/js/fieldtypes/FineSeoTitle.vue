<template>
    <div>
        <div class="flex items-center gap-4">
            <text-input class="flex-grow" :append="true" :classes="{ 'text-gray-800 bg-gray-400': !value }"
                :value="value ?? this.formValues.title" @input="updateDebounced">
                <template v-slot:append>
                    <div class="flex gap-">
                        <div v-if="!formValues.fine_seo_is_title_custom"
                            class="input-group-prepend rounded-none !border-r-0 flex items-center gap-2">
                            <div class="text-gray-600 px-2">
                                {{ meta.websiteTitle ?? 'Website Title' }}
                            </div>
                        </div>
                        <div class="input-group-append relative group">
                            <toggle-input id="isCustomTitle" :value="formValues.fine_seo_is_title_custom"
                                @input="updateIsCustomField" />

                            <!-- Tooltip text -->
                            <div
                                class="absolute bottom-full ltr:right-0 rtl:left-0 mb-2 hidden w-max bg-gray-800 text-white text-sm rounded-md py-1 px-2 group-hover:!block">
                                {{ __('fine-seo::messages.customize_page_title') }}
                            </div>
                        </div>
                    </div>
                </template>
            </text-input>
        </div>
        <progress-bar :value="valueWithWebsiteTitle" :minChars="meta.minChars" :maxChars="meta.maxChars" />
        <p v-if="formValues.fine_seo_is_title_custom" class="text-sm text-gray-600 mt-2">
            {{ __('fine-seo::messages.customize_page_title_long_description') }}
        </p>
    </div>

</template>

<script>
import ProgressBar from '../components/ProgressBar.vue';
export default {
    components: {
        ProgressBar,
    },

    mixins: [Fieldtype],
    inject: ['storeName'],

    data() {
        return {
            //
        };
    },
    computed: {
        formValues() {
            return this.$store.state.publish[this.storeName].values;
        },
        title() {
            return this.formValues.title ?? this.value;
        },
        valueWithWebsiteTitle() {
            return (this.meta.websiteTitle && !this.formValues.fine_seo_is_title_custom) ? this.meta.websiteTitle + ' ' + this.value : this.value;
        },

    },
    methods: {
        updateIsCustomField(newValue) {
            this.$store.dispatch(`publish/${this.storeName}/setFieldValue`, {
                handle: 'fine_seo_is_title_custom',
                value: newValue
            });
        }
    }

};
</script>
