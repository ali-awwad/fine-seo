<template>
    <div>
        <div class="flex items-center gap-4">
            <ui-textarea
                class="grow"
                :model-value="value"
                @update:model-value="updateDebounced"
            />
        </div>
        <ProgressBar :value="value" :minChars="meta.minChars" :maxChars="meta.maxChars" />
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
};
</script>
