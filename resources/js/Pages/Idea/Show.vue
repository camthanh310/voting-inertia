<template>
    <AppLayout :title="idea.title">
        <div>
            <a href="#" class="flex items-center font-semibold hover:underline">
                <ChevronLeftIcon class="w-4 h-4" />
                <span class="ml-2">
                    All Ideas
                </span>
            </a>
        </div>

        <IdeaCard
            :idea="idea"
            :limit="false"
            class="mt-4"
        >
            <template #action>
                <div class="bg-gray-200 text-xxs font-bold uppercase leading-none rounded-full text-center w-28 h-7 py-2 px-4">Open</div>
            </template>

            <template #tag="{ idea }">
                <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2">
                    <div class="hidden md:block font-bold text-gray-900">{{ idea.user.name }}</div>
                    <div class="hidden md:block">&bull;</div>
                    <div>{{ diffForHumans(idea.created_at) }}</div>
                    <div>&bull;</div>
                    <div>Category 1</div>
                    <div>&bull;</div>
                    <div class="text-gray-900">3 Comments</div>
                </div>
            </template>
        </IdeaCard>

        <div class="buttons-container flex items-center justify-between mt-6">
            <div class="flex flex-col md:flex-row items-center space-x-4 md:ml-6">
                <Reply />
                <SetStatus class="mt-2 md:mt-0" />
            </div>

            <div class="hidden md:flex items-center space-x-3">
                <div class="bg-white font-semibold text-center rounded-xl px-3 py-2">
                    <div class="text-xl leading-snug">12</div>
                    <div class="text-gray-400 text-xs leading-none">Votes</div>
                </div>

                <AppSecondaryButton type="button" class="uppercase" width="w-32">
                    Vote
                </AppSecondaryButton>
            </div>
        </div> <!-- end buttons-container  -->

        <Comments />
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import Comments from '@/Components/Comments/Comments.vue'
import IdeaCard from '@/Components/Shares/IdeaCard.vue'
import Reply from '@/Components/Ideas/Reply.vue'
import SetStatus from '@/Components/Ideas/SetStatus.vue'
import AppSecondaryButton from '@/Components/UI/AppSecondaryButton.vue'
import { useDateHelpers } from '@/Composables/useDateHelpers'

defineProps({
    idea: {
        type: Object,
        required: true
    }
})

const { diffForHumans } = useDateHelpers()
</script>