<template>
    <div class="flex flex-col mt-6">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <slot />
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<style lang="postcss">
    thead {
        @apply bg-gray-50 dark:bg-gray-800;
    }

    tbody {
        @apply bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900;
    }

    tbody>tr {
        @apply hover:bg-gray-100/20;
    }

    tbody>tr>td {
        @apply px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap;
    }

    th {
        @apply py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400;
    }
</style>
