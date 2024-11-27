<script setup>
    import InputError from './InputError.vue';
    import InputLabel from './InputLabel.vue';

    const model = defineModel({
        value: null,
        required: true
    });

    defineProps({
        error: String,
        name: String,
    });

</script>

<template>
    <div class="mb-1">
        <InputLabel :value="name" />
        <select class="bg-transparent block w-full rounded-lg" :aria-invalid="error" v-model="model" >
            <slot />
        </select>
        <InputError :message="error" />
    </div>
</template>

<style scoped lang="postcss">
    select {
        @apply block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring;
    }

    [aria-invalid] {
        @apply focus:border-red-500 focus:ring-red-400 focus:ring-opacity-40 dark:focus:border-red-400 ring-1 ring-red-500;
    }
</style>
