<script setup>
import { onMounted, ref } from 'vue';

defineProps({
    modelValue: String,
    options: Array,
});

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <select
        ref="input"
        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
        @input="$emit('update:modelValue', $event.target.value)"
    >
        <option disabled selected value="">Please select one</option>
        <option v-for="option in options" :value="option">{{ option }}</option>

    </select>
</template>
