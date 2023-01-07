<script setup>
import { computed } from 'vue'

const props = defineProps({
    idea: {
        type: Object,
        required: true
    }
})

const statusClasses = computed(() => props.idea.status.classes)
</script>

<template>
    <div
        class="text-xxs font-bold uppercase leading-none rounded-full text-center w-28 h-7 py-2 px-4"
        :class="[statusClasses]"
    >
        {{ idea.status.name }}
    </div>
</template>
