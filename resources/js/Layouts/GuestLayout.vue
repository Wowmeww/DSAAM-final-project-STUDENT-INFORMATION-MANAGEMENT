<script setup>

</script>

<template>
    <div class="bg-slate-600 min-h-screen flex flex-col">

        <main class="flex-1 relative">
           <div class="absolute inset-0">
               <slot />
            </div>

        </main>
    </div>
</template>

<style scoped lang="postcss">
    .nav-link {
        @apply text-gray-800 transition-colors duration-300 transform dark:text-gray-200  mx-1.5 sm:mx-6;
    }
    .active-nav-link {
        @apply border-b-2 border-blue-500 ;
    }
</style>
