<script setup>
defineProps({
    value: {
        type: String,
    },
});
</script>

<template>
    <label class="text-gray-700 dark:text-gray-200" :for="value" >
        {{ value }}
    </label>
</template>
