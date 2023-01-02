<template>
    <AppSkeleton>
        <IdeaCard
            :idea="idea"
            :limit="limit"
            :card-footer-class="cardFooterClass"
            :has-title="hasTitle"
            :has-vote="hasVote"
        >
            <template #left-panel>
                <slot name="left-panel" />
            </template>

            <template #card-image>
                <div class="bg-slate-200 w-14 h-14 rounded-xl"></div>
            </template>

            <template #title>
                <div class="text-transparent bg-slate-200 line-clamp-1">
                    {{ idea.title }}
                </div>
            </template>

            <template #description>
                <div class="text-transparent bg-slate-200">
                    {{ idea.description }}
                </div>
            </template>

            <template #tag>
                <slot name="tag">
                    <div class="text-transparent bg-slate-200 h-6">23 hours ago</div>
                    <div>&bull;</div>
                    <div class="text-transparent bg-slate-200 h-6">Category 1</div>
                    <div>&bull;</div>
                    <div class="text-transparent bg-slate-200 h-6">3 Comments</div>
                </slot>
            </template>

            <template #action>
                <div class="bg-slate-200 text-xxs font-bold uppercase leading-none rounded-full text-center w-28 h-7 py-2 px-4 text-transparent">Open</div>
            </template>

            <template #idea-action>
                <div class="h-7 bg-slate-200 py-2 px-3 rounded-full text-transparent">
                    hello
                </div>
            </template>
        </IdeaCard>
    </AppSkeleton>
</template>

<script setup>
import AppSkeleton from '@/Components/UI/AppSkeleton.vue'
import IdeaCard from '@/Components/Shares/IdeaCard.vue'

defineProps({
    limit: {
        type: Boolean,
        default: true
    },
    hasTitle: {
        type: Boolean,
        default: true
    },
    hasVote: {
        type: Boolean,
        default: true
    },
    cardFooterClass: {
        type: String,
        default: 'flex-col md:flex-row md:items-center'
    }
})

const idea = {
    id: Math.random().toString(),
    title: 'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
    description: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptas veniam facilis aliquam similique ipsum architecto. Qui temporibus fuga deserunt laborum possimus. Omnis, hic nemo alias dicta vero est. Corporis, explicabo.',
    slug: ''
}
</script>