<template>

    <div>
        <div class="flex items-center gap-4">
            <text-input class="flex-grow" 
            :append="true" 
            :classes="{ 'text-gray-800 bg-gray-400': !value }"
            :value="value ?? this.formValues.title" @input="updateDebounced">
                <template v-slot:append>
                    <div class="input-group-append">
                        <div class="text-gray-600 px-2">
                            {{ meta.websiteTitle }}
                        </div>
                    </div>
                </template>
            </text-input>
        </div>
        <progress-bar :value="value" :minChars="meta.minChars" :maxChars="meta.maxChars" />
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
            return this.meta.websiteTitle + ' ' + this.value;
        },
        
    },

};
</script>
