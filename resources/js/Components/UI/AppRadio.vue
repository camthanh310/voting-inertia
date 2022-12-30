<template>
    <label class="inline-flex items-center">
        <input
            class="form-radio bg-gray-200 border-none"
            type="radio"
            :checked="modelValue === value"
            v-bind="{
                ...$attrs,
                onChange: updateValue
            }"
            :class="color"
        >
        <span class="ml-2">{{ label }}</span>
    </label>
</template>

<script setup>
import { useSetupForm } from '@/Composables/useSetupForm'

const props = defineProps({
    label: {
        type: String,
        default: ''
    },
    modelValue: {
        type: [String, Number]
    },
    value: {
        type: [String, Number]
    },
    color: {
        type: String,
        default: 'text-gray-600'
    }
})

const emit = defineEmits(['update:modelValue'])

const { updateValue } = useSetupForm(props, emit)
</script>