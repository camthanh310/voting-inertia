<template>
    <IdeaCard
        :idea="idea"
        class="bg-white rounded-xl flex mt-4 relative before:absolute before:block before:top-[57px] before:content-[''] last:after:absolute last:after:block last:after:top-[60px] last:after:-left-10 last:after:content-[''] last:after:w-0.7 last:after:h-[calc(100%-60px)] last:after:bg-gray-background"
        :class="[
            idea.is_admin
                ? 'before:w-9.5 before:h-9.5 before:rounded-full before:border-8 before:border-white before:bg-purple before:opacity-100 before:-left-[58px] before:shadow-card is-admin'
                : 'before:w-[23px] before:h-0.7 before:bg-gray-lighter before:-left-10'
        ]"
        :has-title="idea.is_admin"
        :has-vote="false"
        card-footer-class="items-center"
    >
        <template #title>
            Status Changed to "Under Consideration"
        </template>

        <template #tag>
            <div
                class="font-bold"
                :class="[idea.is_admin ? 'text-blue' : 'text-gray-900']"
            >
                {{ idea.user }}
            </div>
            <div>&bull;</div>
            <div>10 hours ago</div>
        </template>
    </IdeaCard>
</template>

<script setup>
import IdeaCard from '../Shares/IdeaCard.vue'

defineProps({
    idea: {
        type: Object,
        default: () => ({})
    }
})
</script>