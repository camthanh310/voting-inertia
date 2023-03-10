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


        <div class="mt-4">
            <template v-if="completed">
                <IdeaCard
                    :idea="idea"
                    :limit="false"
                >
                    <template #action="{ idea }">
                        <IdeaStatus :idea="idea" />
                    </template>
                    <template #tag="{ idea }">
                        <div class="hidden md:block font-bold text-gray-900">{{ idea.user.name }}</div>
                        <div class="hidden md:block">&bull;</div>
                        <div>{{ diffForHumans(idea.created_at) }}</div>
                        <div>&bull;</div>
                        <div>{{ idea.category.name }}</div>
                        <div>&bull;</div>
                        <div class="text-gray-900">3 Comments</div>
                    </template>
                </IdeaCard>
            </template>

            <template v-else>
                <IdeaLoading>
                    <template #tag>
                        <div class="hidden md:block font-bold text-gray-900 text-transparent bg-slate-200 h-6">John Doe</div>
                        <div class="hidden md:block">&bull;</div>
                        <div class="text-transparent bg-slate-200 h-6">23 hours ago</div>
                        <div>&bull;</div>
                        <div class="text-transparent bg-slate-200 h-6">Category 1</div>
                        <div>&bull;</div>
                        <div class="text-transparent bg-slate-200 h-6">3 Comments</div>
                    </template>
                </IdeaLoading>
            </template>
        </div>

        <div class="buttons-container flex items-center justify-between mt-6">
            <div class="flex flex-col md:flex-row items-center space-x-4 md:ml-6">
                <template v-if="completed">
                    <Reply />
                    <SetStatus class="mt-2 md:mt-0" />
                </template>
                <template v-else>
                    <div class="bg-slate-200 w-32 h-11 rounded-xl px-6 py-3"></div>
                    <div class="bg-slate-200 w-36 h-11 rounded-xl px-6 py-3 mt-2 md:mt-0"></div>
                </template>
            </div>

            <div class="hidden md:flex items-center space-x-3">
                <div class="bg-white font-semibold text-center rounded-xl px-3 py-2">
                    <div
                        class="text-xl leading-snug"
                        :class="{
                            'bg-slate-200 text-transparent': !completed,
                            'text-blue': idea.has_voted
                        }"
                    >
                        {{ idea.votes_count }}
                    </div>
                    <div
                        class="text-gray-400 text-xs leading-none"
                        :class="{ 'bg-slate-200 text-transparent': !completed }"
                    >
                        Votes
                    </div>
                </div>

                <IdeaVote
                    :idea="idea"
                    :custom-classes="['uppercase', !completed ? 'bg-slate-200 text-transparent pointer-events-none' : '']"
                    width="w-32"
                />
            </div>
        </div> <!-- end buttons-container  -->

        <Comments :completed="completed" />
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import Comments from '@/Components/Comments/Comments.vue'
import IdeaCard from '@/Components/Shares/IdeaCard.vue'
import Reply from '@/Components/Ideas/Reply.vue'
import SetStatus from '@/Components/Ideas/SetStatus.vue'
import { useDateHelpers } from '@/Composables/useDateHelpers'
import { router } from '@inertiajs/vue3'
import { ref } from 'vue'
import IdeaLoading from '@/Components/Shares/IdeaLoading.vue'
import IdeaStatus from '@/Components/Shares/IdeaStatus.vue'
import IdeaVote from '@/Components/Shares/IdeaVote.vue'

const props = defineProps({
    idea: {
        type: Object,
        required: true
    }
})

const { diffForHumans } = useDateHelpers()

const completed = ref(false)
router.visit(
    route('idea.show', { idea: props.idea }),
    {
        method: 'GET',
        preserveState: true,
        onBefore: visit => {
            completed.value = visit.completed
        },
        onError: errors => {
            console.log('onError', errors);
        },
        onFinish: visit => {
            completed.value = visit.completed
        },
    }
)
</script>