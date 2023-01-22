<script setup>
import { computed, onMounted, ref, watchEffect, reactive } from 'vue'
import { Link, usePage } from '@inertiajs/vue3'

const statusFilter = ref('')

const leftStatuses = reactive([
    { id: '', key: 'all_statuses', name: 'All Ideas', count: 0 },
    { id: 2, key: 'CONSIDERING', name: 'Considering', count: 0 },
    { id: 3, key: 'IN_PROGRESS', name: 'In Progress', count: 0 },
])

const rightStatuses = reactive([
    { id: 4, key: 'IMPLEMENTED', name: 'Implemented', count: 0 },
    { id: 5, key: 'CLOSED', name: 'Closed', count: 0 }
])

function setStatus(statusKey) {
    // console.log('goodjob');
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

const ideaStatusCount = computed(() => usePage().props.idea.status_count)

function setStatusCount(statuses) {
    statuses.forEach((status, index) => {
        const statusKey = status['key']

        if (typeof ideaStatusCount.value[statusKey] !== 'undefined') {
            statuses[index]['count'] = ideaStatusCount.value[statusKey]
        }
    })
}

onMounted(() => {
    setStatusCount(leftStatuses)
    setStatusCount(rightStatuses)
})
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
