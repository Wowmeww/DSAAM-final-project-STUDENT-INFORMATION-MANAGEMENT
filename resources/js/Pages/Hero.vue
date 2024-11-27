<script setup>
    import GuestLayout from '@/Layouts/GuestLayout.vue';
    import heroImage from '@/assets/images/book-lover-81.svg'

    defineOptions({
        layout: GuestLayout
    });
</script>
<template>
    <header class="bg-white dark:bg-gray-900 flex">
        <div class="container px-6 py-16 mx-auto">
            <div class="items-center lg:flex">
                <div class="w-full lg:w-1/2">
                    <div class="lg:max-w-lg">
                        <h1 class="hero-title">Database Security Administration And Management Final Project</h1>

                        <p class="mt-3 text-gray-600 dark:text-gray-400">
                            This Web application is a Student Information Management System <i>'issh medyo'</i>.
                        </p>

                        <Link :href="route('login')" class="hero-button">Log in</Link>
                    </div>
                </div>

                <div class="hero-img-container">
                    <img class="w-full h-full lg:max-w-3xl" :src="heroImage">
                </div>
            </div>
        </div>
    </header>
</template>


<style lang="postcss" scoped>
    .hero-title {
        @apply text-3xl font-semibold text-gray-800 dark:text-white lg:text-4xl;
    }

    .hero-button {
        @apply w-full px-5 py-2 mt-6 block text-center text-sm tracking-wider text-white uppercase transition-colors duration-300 transform bg-blue-600 rounded-lg lg:w-auto hover:bg-blue-500 focus:outline-none focus:bg-blue-500 font-semibold;
    }
    .hero-img-container {
        @apply flex items-center justify-center w-full mt-6 lg:mt-0 lg:w-1/2;
    }
</style>
