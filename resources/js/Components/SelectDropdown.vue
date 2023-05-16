<script setup>
import { onMounted, ref } from 'vue';

const props = defineProps({
  modelValue: String,
  options: Array,
});

const input = ref(null);

onMounted(() => {
  if (input.value && input.value.hasAttribute('autofocus')) {
    input.value.focus();
  }
});

const emit = defineEmits(['update:modelValue']);

const emitUpdate = (value) => {
  const inputValue = value.target.value;
  emit('update:modelValue', inputValue);
};


defineExpose({ focus: () => input.value && input.value.focus() });
</script>

<template>
  <select
    ref="input"
    class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
    v-model="props.modelValue"
    @change="emitUpdate"
  >
    <option disabled value="">Please select one</option>
    <option v-for="option in props.options" :value="option">{{ option }}</option>
  </select>
</template>
