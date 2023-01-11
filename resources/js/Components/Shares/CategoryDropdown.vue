<script setup>
import AppSelect from '@/Components/UI/AppSelect.vue'
import { onMounted, ref } from 'vue'

defineProps({
    classes: {
        type: String,
        default: ''
    }
})

const categories = ref([])

async function fetchCategories() {
    try {
        const response = await axios.get(route('categories.index'))
        categories.value = response.data
    } catch (error) {
        console.log('TODO error');
    }
}

onMounted(() => {
    fetchCategories()
})
</script>

<template>
    <AppSelect
        id="category-add"
        :options="categories"
        :class="classes"
    />
</template>
