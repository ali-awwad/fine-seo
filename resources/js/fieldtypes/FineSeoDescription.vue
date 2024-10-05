<template>

    <div>
        <div class="flex items-center gap-4">
            <textarea-input class="flex-grow" :value="value" @input="updateDebounced" />
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

    data() {
        return {
            //
        };
    },

};
</script>
