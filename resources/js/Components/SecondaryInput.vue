<script setup>
    const model = defineModel({
        required: true,
        default: null
    });
    defineProps({
        label: String,
        type: 'text',
        error: String,
        options: Array
    })
</script>
<template>
    <div class="input-container" v-if="type == 'textarea'">
        <label :for="label" class="">{{ label }}</label>
        <textarea :id="label" :placeholder="label" v-model="model"></textarea>
    </div>

    <div class="input-container" v-else-if="type == 'select'">
        <label :for="label">{{ label }}</label>
        <select v-model="model">
            <option :value="null">Select {{ label }}</option>
            <option v-for="option in options" :key="option" :value="option" class="capitalize" >{{ option.toUpperCase() }}</option>
        </select>
    </div>
    <div class="input-container" v-else>
        <label :for="label" class="">{{ label }}</label>
        <input :type="type" :placeholder="label" v-model="model" />
        <small v-if="error">{{ error }}</small>
    </div>

</template>
<style scoped lang="postcss">

    .input-container {
        @apply w-full mb-4 lg:mt-6;
    }

    .input-container>label {
        @apply dark:text-gray-300;
    }

    .input-container>input,
    .input-container>select,
    .input-container>textarea {
        @apply mt-2 p-4 w-full border-2 rounded-lg dark:text-gray-200 dark:border-gray-600 dark:bg-gray-800;
    }

    .input-container>small {
        @apply font-bold text-red-600;
    }

    .option {
        @apply capitalize;
    }
</style>
