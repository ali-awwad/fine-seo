<template>
    <div>
        <div class="flex gap-4 justify-end max-w-lg w-full">
            <img v-if="image" class="w-24 h-24 object-cover rounded-lg" :src="image" alt="SEO Preview Image">
            <div v-else class="w-24 h-24 bg-gray-200 rounded-lg"></div>

            <div class="grow items-start align-top">
                <h2 class="text-lg sm:text-xl font-bold text-blue-700 text-wrap">
                    {{ finalTitle }}
                </h2>

                <p v-if="meta.url" class="text-sm text-green-600 truncate">
                    {{ meta.url }}
                </p>

                <p class="text-sm sm:text-base text-gray-700 mt-1">
                    {{ truncatedDescription }}
                </p>
            </div>
        </div>
    </div>
</template>

<script>
import { FieldtypeMixin as Fieldtype } from '@statamic/cms';

export default {
    mixins: [Fieldtype],

    data() {
        return {
            image: '',
        };
    },

    computed: {
        formValues() {
            return this.publishContainer.values;
        },
        truncatedDescription() {
            const desc = this.formValues.fine_seo_description;
            if (!desc) return '';

            return desc.length > this.meta.maxChars
                ? desc.substring(0, this.meta.maxChars) + '...'
                : desc;
        },
        finalTitle() {
            return (!this.formValues.fine_seo_is_title_custom || !this.meta.websiteTitle)
                ? this.formValues.fine_seo_title + ' ' + this.meta.websiteSeparator + ' ' + this.meta.websiteTitle
                : this.formValues.fine_seo_title;
        },
    },

    watch: {
        'formValues.fine_seo_image': {
            handler: 'loadImage',
            immediate: true,
        },
    },

    methods: {
        loadImage(images) {
            if (!images || images.length === 0) return;

            this.$axios.post(cp_url('assets-fieldtype'), {
                assets: images,
            }).then(response => {
                if (Array.isArray(response.data) && response.data.length > 0) {
                    this.image = response.data[0].permalink;
                }
            });
        },
    },
};
</script>
