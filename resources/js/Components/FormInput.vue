<script setup>
    import InputError from './InputError.vue';
    import InputLabel from './InputLabel.vue';
    import TextInput from './TextInput.vue';

    const model = defineModel({
        value: null,
        required: true
    });

    defineProps({
        type: String,
        error: String,
        name: String,
        disabled: false
    });

</script>

<template>
    <div class="mb-1">
        <InputLabel :value="name" />
        <TextInput :type="type" :name="name" v-model="model" :invalid="error" :disabled="disabled" />
        <InputError :message="error" />
    </div>
</template>
