<template>
    <component
        :is="tag"
        class="h-11 bg-blue text-white font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3"
        :class="[flex ? 'flex items-center justify-center' : '', width, size, customClasses]"
        v-bind="$attrs"
    >
        <slot />
    </component>
</template>

<script setup>
const props = defineProps({
    flex: {
        type: Boolean,
        default: true
    },
    width: {
        type: String,
        default: 'w-1/2'
    },
    size: {
        type: String,
        default: 'text-xs'
    },
    tag: {
        type: [String, Object],
        default: 'button'
    },
    customClasses: {
        type: [String, Array],
        default: ''
    }
})
</script>
