<script setup>
    import { ref } from 'vue';

    const props = defineProps({
        value: String,
    })
    const emit = defineEmits([
        'check'
    ]);

    const checked = ref(false);

    const change = (e) => {
        checked.value = !checked.value;
        emit('check', { checked: e.target.checked, value: props.value });
    }
</script>
<template>
    <div class="relative flex gap-x-3 py-1">
        <div class="flex h-6 items-center">
            <input :id="value" :name="value" type="checkbox"
                class="size-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600" @change="change"
                :checked="checked" />
        </div>
        <div class="text-sm/6">
            <label :for="value" class="font-medium text-gray-900 dark:text-white">{{ value }}</label>
        </div>
    </div>
</template>

<style lang="postcss" scoped></style>
