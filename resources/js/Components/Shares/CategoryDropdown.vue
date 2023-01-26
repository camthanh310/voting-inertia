<script setup>
import AppSelect from '@/Components/UI/AppSelect.vue'
import { usePage } from '@inertiajs/vue3'
import { computed } from 'vue'

defineProps({
    classes: {
        type: String,
        default: ''
    }
})

const categories = computed(() => usePage().props.categories)
</script>

<template>
    <AppSelect
        id="category-add"
        :options="categories"
        :class="classes"
    >
        <slot />
    </AppSelect>
</template>
