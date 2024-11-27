<script setup>
    defineProps({
        value: null,
        type: 'button',
        disabled: false
    });
</script>

<template>
    <button :type="type" :disabled="disabled"
        class="inline-flex items-center rounded-md border border-transparent justify-center bg-red-600 px-6 py-2 font-medium tracking-wide  text-white transition duration-150 ease-in-out hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 active:bg-red-700 dark:focus:ring-offset-gray-800">
        {{ value }}
        <slot />
    </button>
</template>
