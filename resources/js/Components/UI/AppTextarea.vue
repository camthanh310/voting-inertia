<template>
    <textarea
        cols="30"
        rows="4"
        class="w-full text-sm bg-gray-100 rounded-xl placeholder-gray-900 border-none px-4 py-2"
        :value="modelValue"
        v-bind="{
            ...$attrs,
            onInput: updateValue
        }"
    ></textarea>
</template>

<script setup>
import { useSetupForm } from '@/Composables/useSetupForm.js'
const props = defineProps({
    modelValue: {},
})

const emit = defineEmits(['update:modelValue'])

const { updateValue } = useSetupForm(props, emit)
</script>