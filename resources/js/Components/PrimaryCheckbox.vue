<script setup>
    import { ref } from 'vue';

    const props = defineProps({
        value: '',
        checked: false,
        label: String
    })
    const emit = defineEmits([
        'changed'
    ]);

    const change = (e) => {
        emit('changed', { value: props.value, checked: e.target.checked });
    }
</script>
<template>
    <div class="relative flex gap-x-3 py-1">
        <div class="flex h-6 items-center">
            <input :id="label" type="checkbox"
                class="size-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600" @change="change"
                :checked="checked" />
        </div>
        <div class="text-sm/6">
            <label :for="label" class="font-medium text-gray-900 dark:text-white">{{ label }}</label>
        </div>
    </div>
</template>


<style lang="postcss">

</style>
