<script setup>
    const props = defineProps({
        isOpen: {
            type: Boolean,
            default: false
        }
    });
    defineEmits(['cancel']);
</script>

<template>
    <div v-if="isOpen" class="flex justify-center absolute z-50 inset-0 bg-white/5 min-h-full pt-[30vh] ">

        <div class="grid place-content-start h-full px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="modal">
                <div>
                    <div class="flex items-center justify-center flex-col">
                        <i class="bi-box-arrow-right text-4xl"></i>
                        <div class="mt-2 text-center">
                            <h3 class="text-lg font-medium leading-6 text-gray-800 capitalize dark:text-white"
                                id="modal-title">Log out</h3>
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                Lorem, ipsum dolor sit amet consectetur
                                adipisicing elit.
                            </p>
                        </div>
                    </div>

                    <div class="mt-5 sm:flex sm:items-center sm:justify-end">
                        <div class="sm:flex sm:items-center ">
                            <button @click="$emit('cancel')" class="cancel-button">
                                Cancel
                            </button>

                            <Link class="logout-button" as="button" type='button' :href="route('logout')" method="delete">
                                Log out
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped lang="postcss">
    .cancel-button {
        @apply w-full px-4 py-2 mt-2 text-sm font-medium tracking-wide text-gray-700 capitalize transition-colors duration-300 transform border border-gray-200 rounded-md sm:mt-0 sm:w-auto sm:mx-2 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800 hover:bg-gray-100 focus:outline-none focus:ring focus:ring-gray-300 focus:ring-opacity-40;
    }

    .logout-button {
        @apply w-full px-4 py-2 mt-2 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-600 rounded-md sm:w-auto sm:mt-0 hover:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40;
    }

    .modal {
        @apply relative inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl rtl:text-right dark:bg-gray-900 sm:my-8 sm:align-middle sm:max-w-sm sm:w-full sm:p-6;
    }

</style>
