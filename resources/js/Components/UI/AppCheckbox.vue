<template>
    <label class="font-normal inline-flex items-center">
        <input
            class="form-checkbox rounded bg-gray-200"
            type="checkbox"
            :checked="modelValue"
            v-bind="{
                ...$attrs,
                onChange: updateValue
            }"
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
        type: Boolean
    }
})

const emit = defineEmits(['update:modelValue'])

const { updateValue } = useSetupForm(props, emit)
</script>