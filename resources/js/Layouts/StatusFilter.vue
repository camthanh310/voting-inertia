<script setup>
import { Link, router, usePage } from '@inertiajs/vue3'
import { computed, ref, watchEffect } from 'vue'

defineProps({
    status: {
        type: Object,
        required: true,
    }
})

const emit = defineEmits(['on-update-query-string'])

const statusFilter = ref('')


function setStatus(statusKey) {
    statusFilter.value = statusKey
    // console.log('good job too');
    // emit('on-update-query-string', { status_id: statusFilter.value} )
    router.visit(
        route('idea.index'),
        {
            method: 'get',
            preserveState: true,
            data: {
                filter: {
                    status_id: statusFilter.value,
                    category_id: '',
                    my_ideas: ''
                },
                sort: ''
            },
            onBefore: visit => {
                // completed.value = visit.completed
            },
            onError: errors => {
                console.log('onError', errors);
            },
            onFinish: visit => {
                // completed.value = visit.completed
            },
        }
    )
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
            class="border-b-4 pb-3"
            :class="[status.id === statusFilter ? 'border-blue text-gray-900' : 'transition duration-150  hover:border-blue']"
            @click="setStatus(status.id)"
        >
            {{ status.name }} ({{ status.count }})
        </Link>
    </li>
</template>
