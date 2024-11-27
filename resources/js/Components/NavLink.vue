<script setup>
    defineProps({
        label: {
            type: String,
            required: true,
        },
        href: {
            type: String,
            required: true,
        },
        active: {
            type: Boolean,
            default: false
        }
    });
</script>

<template>
    <Link :href="href" class="responsiveNavLink" :class="{ 'active': active }">{{ label }}</Link>
</template>

<style lang="postcss" scoped>

    .responsiveNavLink {
        @apply px-3 py-2 mx-3 mt-2 text-gray-700 transition-colors duration-300 transform rounded-md lg:mt-0 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700;
    }

    .active {
        @apply bg-gray-100 dark:bg-gray-700;
    }
</style>
