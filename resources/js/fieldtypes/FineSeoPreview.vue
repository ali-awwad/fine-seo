<template>

    <div>
        <div class=" flex gap-4 justify-end max-w-lg w-full">
            <!-- Image preview -->
            <img v-if="image"  class="w-24 h-24 object-cover rounded-lg" :src="image" alt="SEO Preview Image">
            <div v-else class="w-24 h-24 bg-gray-200 rounded-lg"></div>
            <!-- Text Preview -->
            <div class="flex-grow items-start align-top">

                <h2 class="text-lg sm:text-xl font-bold text-blue-700 text-wrap">
                    {{ formValues.fine_seo_title }}
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
export default {

    mixins: [Fieldtype],

    // store
    inject: ['storeName'],

    data() {
        return {
            image: '',
        };
    },
    computed: {
        truncatedDescription() {
            if (!this.formValues.fine_seo_description) {
                return '';
            }
            return this.formValues.fine_seo_description.length > this.meta.maxChars ? this.formValues.fine_seo_description.substring(0, this.meta.maxChars) + '...' : this.formValues.fine_seo_description;
        },
        formValues() {
            return this.$store.state.publish[this.storeName].values;
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
            if (!images || images.length === 0) {
                return;
            }
            this.$axios.post(cp_url('assets-fieldtype'), {
                assets: images,
            }).then(response => {
                // if data is array and has length > 0
                if (Array.isArray(response.data) && response.data.length > 0) {
                    this.image = response.data[0].permalink;
                }
            });
        }
    }

};
</script>
