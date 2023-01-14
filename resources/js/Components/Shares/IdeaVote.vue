<script setup>
import AppPrimaryButton from '@/Components/UI/AppPrimaryButton.vue'
import AppSecondaryButton from '@/Components/UI/AppSecondaryButton.vue'
import { Link } from '@inertiajs/inertia-vue3'
import { computed } from 'vue'

const props = defineProps({
    idea: {
        type: Object,
        required: true
    },
    customClasses: {
        type: [String, Array],
        default: ''
    }
})

const customComponent = computed(() => {
    let component = AppSecondaryButton
    let text = 'Vote'

    if (props.idea.has_voted) {
        component = AppPrimaryButton
        text = 'Voted'
    }

    return {
        component,
        text
    }
})
</script>

<template>
    <Component
        :custom-classes="['inline-block', 'text-center', customClasses]"
        :is="customComponent['component']"
        type="button"
        :tag="Link"
        :href="route('vote.store', idea)"
        method="post"
        as="button"
        :data="{ has_voted: idea.has_voted }"
    >
        {{ customComponent['text'] }}
    </Component>
</template>
