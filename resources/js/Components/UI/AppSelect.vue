<template>
    <select
        class="w-full rounded-xl border-none px-4 py-2"
        v-bind="{
            ...$attrs,
            onChange: updateValue
        }"
        :value="modelValue"
    >
        <option
            v-for="option in options"
            :value="option.value || option"
            :key="option.value || option"
            :selected="option.value || option === modelValue"
        >
            {{ option.text || option }}
        </option>
    </select>
</template>

<script setup>
import { useSetupForm } from '@/Composables/useSetupForm';

const props = defineProps({
    options: {
        type: Array,
        required: true
    },
    modelValue: {
        type: [String, Number]
    }
})

const emit = defineEmits(['update:modelValue'])

const { updateValue } = useSetupForm(props, emit)
</script>
