<script setup>
    const model = defineModel({
        value: null,
        required: true,
    });

    defineProps({
        type: 'text',
        name: String,
        invalid: false,
        disabled: false
    });

</script>

<template>
    <input :id="name" :type="type" v-model="model" class="form-input" :aria-invalid="invalid" :disabled="disabled" />
</template>

<style scoped lang="postcss">
    .form-input {
        @apply block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring;
    }
    [aria-invalid] {
        @apply focus:border-red-500 focus:ring-red-400 focus:ring-opacity-40 dark:focus:border-red-400 ring-1 ring-red-500;
    }
</style>
