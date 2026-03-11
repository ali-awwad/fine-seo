<template>
    <div class="flex justify-between mt-1 items-center">
        <div class="bg-gray-200 h-1 relative grow">
            <div class="h-1 absolute inset-0 max-w-full" :class="progressColor"
                :style="{ width: (value?.length * 100 / maxChars) + '%' }"></div>
        </div>
        <div class="text-gray-500 text-sm w-24 flex justify-end">
            {{ value?.length }} / {{ maxChars }}
        </div>
    </div>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
    value: String,
    minChars: Number,
    maxChars: Number,
});

const progressColor = computed(() => {
    const len = props.value?.length ?? 0;

    return {
        'bg-yellow-500': len < props.minChars,
        'bg-green-500': len >= props.minChars && len <= props.maxChars,
        'bg-red-500': len > props.maxChars,
    };
});
</script>