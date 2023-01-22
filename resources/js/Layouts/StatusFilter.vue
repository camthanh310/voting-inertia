<script setup>
import { Link, usePage } from '@inertiajs/vue3'
import { computed, ref, watchEffect } from 'vue'

defineProps({
    status: {
        type: Object,
        required: true,
    }
})

const statusFilter = ref('')

function setStatus(statusKey) {
    statusFilter.value = statusKey
}

const pageComponent = computed(() => usePage().component)

watchEffect(
    () => {
        if (pageComponent.value === 'Idea/Show') {
            statusFilter.value = 'Show'
        } else if (pageComponent.value === 'Idea/Index') {
            const status = usePage().props.filter.status_id
            if (['', null].includes(status)) {
                statusFilter.value = ''
            } else {
                statusFilter.value = +status
            }
        }
    }
)

</script>

<template>
    <li>
        <Link
            :href="route('idea.index')"
            class="border-b-4 pb-3"
            :class="[status.id === statusFilter ? 'border-blue text-gray-900' : 'transition duration-150  hover:border-blue']"
            :data="{ filter: { status_id: status.id } }"
            preserve-state
            @click="setStatus(status.id)"
        >
            {{ status.name }} ({{ status.count }})
        </Link>
    </li>
</template>
