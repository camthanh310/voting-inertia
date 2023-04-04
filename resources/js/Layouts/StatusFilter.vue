<script setup>
import { useIdea } from '@/Composables/useIdea';
import { Link } from '@inertiajs/vue3'
import { computed } from 'vue'

defineProps({
    status: {
        type: Object,
        required: true,
    }
})

const queryParams = computed(() => {
    return (status) => {
        return {
            filter: {
                ...queryString.filter,
                status_id: status.id
            },
            sort: queryString.sort
        }
    }
})

const { queryString } = useIdea()

function setQueryString(statusId) {
    queryString.filter.status_id = statusId
}

</script>

<template>
    <li>
        <Link
            :href="$route('idea.index')"
            :data="queryParams(status)"
            class="border-b-4 pb-3"
            :class="[status.id === queryString.filter.status_id ? 'border-blue text-gray-900' : 'transition duration-150  hover:border-blue']"
            preserve-state
            @click="setQueryString(status.id)"
        >
            <!--  -->
            <!--  -->
            {{ status.name }} ({{ status.count }})
        </Link>
    </li>
</template>
