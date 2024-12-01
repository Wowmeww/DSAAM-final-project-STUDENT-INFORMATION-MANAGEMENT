<script setup>
    defineProps({
        value: String
    })
</script>

<template>
    <h2 class="lg:text-3xl md:text-2xl sm:text-xl xs:text-xl font-serif font-extrabold mb-2 dark:text-white">
        {{ value }}
        <slot />
    </h2>
</template>
