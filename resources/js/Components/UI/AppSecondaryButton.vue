<template>
    <component
        :is="tag"
        class="bg-gray-200 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in py-3"
        :class="[flex ? 'flex items-center justify-center' : '', height, width, size, paddingX, customClasses]"
        v-bind="$attrs"
    >
        <slot />
    </component>
</template>

<script setup>
defineProps({
    flex: {
        type: Boolean,
        default: false
    },
    height: {
        type: String,
        default: 'h-11'
    },
    width: {
        type: String,
        default: 'w-1/2'
    },
    size: {
        type: String,
        default: 'text-xs'
    },
    paddingX: {
        type: String,
        default: 'px-6'
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