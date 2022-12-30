<template>
    <input
        :type="type"
        class="w-full border-none rounded-xl placeholder-gray-900 px-4 py-2"
        :class="[size, bgColor]"
        v-bind="{
            ...$attrs,
            onInput: updateValue
        }"
        :value="modelValue"
    >
</template>

<script setup>
import { useSetupForm } from '@/Composables/useSetupForm';

const props = defineProps({
    type: {
        type: String,
        default: 'text'
    },
    size: {
        type: String,
        default: 'text-sm'
    },
    modelValue: {
        type: [String, Number],
        default: ''
    },
    bgColor: {
        type: String,
        default: 'bg-gray-100'
    }
})

const emit = defineEmits(['update:modelValue'])

const { updateValue } = useSetupForm(props, emit)
</script>