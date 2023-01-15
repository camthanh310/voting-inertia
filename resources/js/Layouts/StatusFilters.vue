<script setup>
import { ref } from 'vue'
import { Link } from '@inertiajs/vue3'

const statusFilter = ref('')

const leftStatuses = [
    { id: '', key: '', name: 'All Ideas', count: 87 },
    { id: 2, key: 'Considering', name: 'Considering', count: 8 },
    { id: 3, key: 'InProgressll', name: 'In Progress', count: 1 },
]

const rightStatuses = [
    { id: 4, key: 'Implemented', name: 'Implemented', count: 1 },
    { id: 5, key: 'Closed', name: 'Closed', count: 8 }
]

function setStatus(statusKey) {
    statusFilter.value = statusKey
}
</script>

<template>
    <nav class="hidden md:flex items-center justify-between text-xs text-gray-400">
        <ul class="flex uppercase font-semibold border-b-4 pb-3 space-x-10">
            <li
                v-for="status in leftStatuses"
                :key="status.key"
            >
                <Link
                    :href="route('idea.index')"
                    class="border-b-4 pb-3"
                    :class="[status.key === statusFilter ? 'border-blue text-gray-900' : 'transition duration-150  hover:border-blue']"
                    :data="{ filter: { status_id: status.id } }"
                    preserve-state
                    @click="setStatus(status.key)"
                >
                    {{ status.name }} ({{ status.count }})
                </Link>
            </li>

        </ul>

        <ul class="flex uppercase font-semibold border-b-4 pb-3 space-x-10">
            <li
                v-for="status in rightStatuses"
                :key="status.key"
            >
                <Link
                    :href="route('idea.index')"
                    class="border-b-4 pb-3"
                    :class="[status.key === statusFilter ? 'border-blue text-gray-900' : 'transition duration-150  hover:border-blue']"
                    :data="{ filter: { status_id: status.id } }"
                    preserve-state
                    @click="setStatus(status.key)"
                >
                    {{ status.name }} ({{ status.count }})
                </Link>
            </li>
        </ul>
    </nav>
</template>
