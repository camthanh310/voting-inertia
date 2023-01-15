<script setup>
import { usePage } from '@inertiajs/vue3'
import { computed, ref, watch } from 'vue'

const successMessage = computed(() => usePage().props.flash.success)
const isVisible = ref(true)

watch(
    () => successMessage.value,
    () => {
        isVisible.value = true
        setTimeout(() => {
            isVisible.value = false
        }, 3000)
    }
)
</script>

<template>
    <Transition
        enter-active-class="transition duration-75 ease-out"
        enter-from-class="transform scale-95 opacity-0"
        enter-to-class="transform scale-100 opacity-100"
        leave-active-class="transition duration-100 ease-out"
        leave-from-class="transform scale-100 opacity-100"
        leave-to-class="transform scale-95 opacity-0"
    >
        <div class="text-green mt-4" v-if="isVisible">
            {{  successMessage }}
        </div>
    </Transition>
</template>
