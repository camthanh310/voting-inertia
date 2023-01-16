<template>
    <Float
        portal="#popover"
        enter="transition duration-100 ease-out"
        enter-from="transform scale-95 opacity-0"
        enter-to="transform scale-100 opacity-100"
        leave="transition duration-75 ease-out"
        leave-from="transform scale-100 opacity-100"
        leave-to="transform scale-95 opacity-0"
        tailwindcss-origin-class
    >
        <slot />
    </Float>
</template>

<script setup>
import { Float } from '@headlessui-float/vue'
</script>