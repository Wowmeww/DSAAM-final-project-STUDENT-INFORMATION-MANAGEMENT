<script setup>
    defineProps({
        value: String,
        disabled: false
    })
</script>
<template>
    <button class="large-submit-button" type="submit" :disabled="disabled">
        {{ value }}
        <i class="fa fa-spinner animate-spin" v-show="disabled"></i>
    </button>
</template>
