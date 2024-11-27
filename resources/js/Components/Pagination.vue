<script setup>
    defineProps({
        paginator: Object
    });
</script>
<template>
    <Head title="Students"/>
    <div class="flex items-center justify-between mt-6">
        <component :href="paginator.prev_page_url" :is="paginator.prev_page_url? 'Link': 'span'" :disabled="!Boolean(paginator.prev_page_url)"
            class="pagination-button">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-5 h-5 rtl:-scale-x-100">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
            </svg>

            <span>
                previous
            </span>
        </component>

        <component :href="paginator.next_page_url" :is="paginator.next_page_url? 'Link': 'span'" :disabled="!Boolean(paginator.next_page_url)"
            class="pagination-button">
            <span>
                Next
            </span>

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-5 h-5 rtl:-scale-x-100">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
            </svg>
        </component>
    </div>
</template>
<style lang="postcss" scoped>
    .pagination-button {
        @apply flex items-center px-5 py-2 text-sm text-gray-700 capitalize transition-colors duration-200 bg-white border rounded-md gap-x-2 hover:bg-gray-100 dark:bg-gray-900 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800;
    }
    [disabled="true"] {
        @apply cursor-not-allowed opacity-35 ;
    }
</style>
