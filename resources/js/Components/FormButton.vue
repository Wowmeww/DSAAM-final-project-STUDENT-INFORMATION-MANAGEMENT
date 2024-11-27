<script setup>
    defineProps({
        disabled: false,
        value: null,
        type: 'button'
    });
</script>

<template>
    <button class="form-button" :disabled="disabled" :type="type">
        <span>
            {{ value }}
            <slot />
        </span>
        <i class="fa fa-1x fa-spinner animate-spin" v-show="disabled" ></i>
    </button>
</template>

<style scoped lang="postcss">
    .form-button {
        @apply px-6 py-2 font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-600 rounded-lg hover:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-80 space-x-2;
    }
    [disabled] {
        @apply cursor-not-allowed bg-blue-600/35 ring-0 shadow-none hover:bg-blue-600/35;
    }
</style>
