<template>
    <div class="flex justify-between mt-1 items-center">
        <div class="bg-gray-200 h-1 relative flex-grow">
            <div class="h-1 absolute inset-0 max-w-full" :class="progressColor"
                :style="{ width: (value?.length * 100 / maxChars) + '%' }"></div>
        </div>
        <div class="text-gray-500 text-sm w-24 flex justify-end">
            {{ value?.length }} / {{ maxChars }}
        </div>
    </div>
</template>

<script>

    export default {
        mounted() {
            console.log('ProgressBar mounted');
        },
        props: ['value', 'minChars', 'maxChars'],

        mixins: [Fieldtype],

        data() {
            return {
                //
            };
        },
        computed: {
            progressColor() {
                return {
                    'bg-yellow-500': this.value?.length < this.minChars,
                    'bg-green-500': this.value?.length >= this.minChars && this.value?.length <= this.maxChars,
                    'bg-red-500': this.value?.length > this.maxChars,

                };
            }
        },

    };
</script>