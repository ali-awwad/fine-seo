<script setup>
import { Head, router } from '@statamic/cms/inertia';
import { Card, Heading, Header, Button, Checkbox, CheckboxGroup, Alert } from '@statamic/cms/ui';
import { ref } from 'vue';

const props = defineProps({
    title: String,
    collections: Array,
});

const selectedCollections = ref(
    props.collections.filter(c => c.hasFineSeo).map(c => c.handle)
);

const submitting = ref({
    collections: false,
    config: false,
    brand: false,
});

function submitCollections() {
    submitting.value.collections = true;
    router.post(cp_url('fine-seo/setup'), {
        collections: selectedCollections.value,
    }, {
        onFinish: () => submitting.value.collections = false,
    });
}

function setupConfig() {
    submitting.value.config = true;
    router.post(cp_url('fine-seo/config'), {}, {
        onFinish: () => submitting.value.config = false,
    });
}

function setupBrand() {
    submitting.value.brand = true;
    router.post(cp_url('fine-seo/brand'), {}, {
        onFinish: () => submitting.value.brand = false,
    });
}
</script>

<template>
    <Head :title="__('fine-seo::messages.seo_title')" />

    <Header>
        <Heading :text="__('fine-seo::messages.seo_title')" />
    </Header>

    <div class="space-y-4">
        <Card>
            <Heading :level="2" :text="__('fine-seo::messages.setup_heading')" />
            <p class="mt-2 text-sm text-gray-700">
                {{ __('fine-seo::messages.about_paragraph_1') }}
            </p>
            <p class="mt-1 text-sm text-gray-700">
                {{ __('fine-seo::messages.about_paragraph_2') }}
            </p>
        </Card>

        <Card>
            <Heading :level="3" :text="__('fine-seo::messages.setup_collections')" />

            <div class="mt-3 space-y-2">
                <p class="text-sm font-medium text-gray-600">
                    {{ __('fine-seo::messages.select_collections') }}
                </p>

                <CheckboxGroup v-model="selectedCollections" inline>
                    <Checkbox
                        v-for="collection in collections"
                        :key="collection.handle"
                        :value="collection.handle"
                        :label="collection.title"
                    />
                </CheckboxGroup>
            </div>

            <div class="mt-4">
                <Button
                    variant="primary"
                    :text="__('fine-seo::messages.setup_collections')"
                    :disabled="submitting.collections"
                    @click="submitCollections"
                />
            </div>
        </Card>

        <Card>
            <Heading :level="3" :text="__('fine-seo::messages.setup_global_config')" />

            <Alert class="mt-3">
                {{ __('fine-seo::messages.setup_global_config_warning') }}
            </Alert>

            <div class="mt-4">
                <Button
                    :text="__('fine-seo::messages.setup_global_config')"
                    :disabled="submitting.config"
                    @click="setupConfig"
                />
            </div>
        </Card>

        <Card>
            <Heading :level="3" :text="__('fine-seo::messages.setup_global_brand')" />

            <Alert class="mt-3">
                {{ __('fine-seo::messages.setup_global_brand_warning') }}
            </Alert>

            <div class="mt-4">
                <Button
                    :text="__('fine-seo::messages.setup_global_brand')"
                    :disabled="submitting.brand"
                    @click="setupBrand"
                />
            </div>
        </Card>
    </div>
</template>
