<template>
    <component :is="htmlTag" class="animate-pulse">
        <slot />
    </component>
</template>

<script setup>
defineProps({
    htmlTag: {
        type: String,
        default: 'div'
    }
})
</script>