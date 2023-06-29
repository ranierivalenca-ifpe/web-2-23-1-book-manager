<script setup>
import { onMounted, ref } from 'vue';

defineProps({
    modelValue: {
        type: String,
        required: true,
    },
    title: {
        type: String,
        required: false,
        default: null,
    },
    type: {
        type: String,
        required: false,
        default: 'text',
    },
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
    <div class="border border-gray-300 rounded-md shadow-sm focus-within:border-indigo-500 focus-within:ring-indigo-500">
        <span class="text-xs ml-2 text-gray-700 block mt-0.5" v-if="title">{{ title }}</span>
        <input :type="type" class="border-0 border-transparent focus:border-transparent focus:ring-0 p-0 m-0 pl-2 w-full" :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)" ref="input">
    </div>
</template>