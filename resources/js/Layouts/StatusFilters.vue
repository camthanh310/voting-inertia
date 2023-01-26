<script setup>
import { computed, onMounted, reactive } from 'vue'
import { usePage } from '@inertiajs/vue3'
import StatusFilter from '@/Layouts/StatusFilter.vue'
import StatusNav from '@/Layouts/StatusNav.vue'

const emit = defineEmits(['on-update-query-string'])

function onUpdateQueryString(query) {
    emit('on-update-query-string', query)
}

const leftStatuses = reactive([
    { id: '', key: 'all_statuses', name: 'All Ideas', count: 0 },
    { id: 2, key: 'CONSIDERING', name: 'Considering', count: 0 },
    { id: 3, key: 'IN_PROGRESS', name: 'In Progress', count: 0 },
])

const rightStatuses = reactive([
    { id: 4, key: 'IMPLEMENTED', name: 'Implemented', count: 0 },
    { id: 5, key: 'CLOSED', name: 'Closed', count: 0 }
])

const ideaStatusCount = computed(() => usePage().props.status_count)

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
        <StatusNav>
            <StatusFilter
                v-for="status in leftStatuses"
                :key="status.id"
                :status="status"
                @on-update-query-string="onUpdateQueryString"
            />
        </StatusNav>

        <StatusNav>
            <StatusFilter
                v-for="status in rightStatuses"
                :key="status.id"
                :status="status"
                @on-update-query-string="onUpdateQueryString"
            />
        </StatusNav>
    </nav>
</template>
