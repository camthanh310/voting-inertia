<script setup>
import { computed, ref, watchEffect } from 'vue'
import { Link, usePage } from '@inertiajs/vue3'

const statusFilter = ref('')

const leftStatuses = [
    { id: '', name: 'All Ideas', count: 87 },
    { id: 2, name: 'Considering', count: 8 },
    { id: 3, name: 'In Progress', count: 1 },
]

const rightStatuses = [
    { id: 4, name: 'Implemented', count: 1 },
    { id: 5, name: 'Closed', count: 8 }
]

function setStatus(statusKey) {
    console.log('goodjob');
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
                statusFilter.value = status
            }
        }
    }
)
</script>

<template>
    <nav class="hidden md:flex items-center justify-between text-xs text-gray-400">
        <ul class="flex uppercase font-semibold border-b-4 pb-3 space-x-10">
            <li
                v-for="status in leftStatuses"
                :key="status.id"
            >
                <Link
                    :href="route('idea.index')"
                    class="border-b-4 pb-3"
                    :class="[status.id === +statusFilter ? 'border-blue text-gray-900' : 'transition duration-150  hover:border-blue']"
                    :data="{ filter: { status_id: status.id } }"
                    preserve-state
                    @click="setStatus(status.id)"
                >
                    {{ status.name }} ({{ status.count }})
                </Link>
            </li>

        </ul>

        <ul class="flex uppercase font-semibold border-b-4 pb-3 space-x-10">
            <li
                v-for="status in rightStatuses"
                :key="status.id"
            >
                <Link
                    :href="route('idea.index')"
                    class="border-b-4 pb-3"
                    :class="[status.id === +statusFilter ? 'border-blue text-gray-900' : 'transition duration-150  hover:border-blue']"
                    :data="{ filter: { status_id: status.id } }"
                    preserve-state
                    @click="setStatus(status.id)"
                >
                    {{ status.name }} ({{ status.count }})
                </Link>
            </li>
        </ul>
    </nav>
</template>
