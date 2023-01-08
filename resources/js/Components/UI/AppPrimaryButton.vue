<template>
    <component
        :is="as"
        class="h-11 bg-blue text-white font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3"
        :class="[flex ? 'flex items-center justify-center' : '', width, size]"
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
    as: {
        type: String,
        default: 'button'
    }
})
</script>
