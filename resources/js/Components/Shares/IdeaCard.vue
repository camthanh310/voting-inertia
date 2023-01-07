<template>
    <div class="bg-white rounded-xl flex">
        <slot name="left-panel" />

        <div class="flex flex-col md:flex-row flex-1 px-2 py-6">
            <div class="flex-none mx-2 md:mx-0">
                <Link
                    :href="ideaUrl"
                    class="flex-none"
                >
                    <slot name="card-image">
                        <img :src="idea.user.avatar_url" alt="avatar" class="w-14 h-14 rounded-xl">
                    </slot>
                </Link>
            </div>

            <div class="w-full flex flex-col justify-between mx-2 md:mx-4">
                <h4 class="text-xl font-semibold mt-2 md:mt-0" v-if="hasTitle">
                    <Link :href="ideaUrl" :class="{ 'hover:underline': ideaUrl }" ref="ideaLinkRef">
                        <slot name="title">
                            {{ idea.title }}
                        </slot>
                    </Link>
                </h4>

                <div
                    class="text-gray-600 mt-3"
                    :class="{ 'line-clamp-3': limit }"
                >
                    <slot name="description">
                        {{ idea.description }}
                    </slot>
                </div>

                <div
                    class="flex justify-between mt-6"
                    :class="cardFooterClass"
                >
                    <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2">
                        <slot name="tag" :idea="idea" />
                    </div>

                    <div class="flex items-center space-x-2 mt-4 md:mt-0">
                        <slot name="action" :idea="idea" />

                        <slot name="idea-action">
                            <IdeaAction />
                        </slot>
                    </div>

                    <div class="flex items-center md:hidden mt-4 md:mt-0" v-if="hasVote">
                        <div class="bg-gray-100 text-center rounded-xl h-10 px-4 py-2 pr-8">
                            <div class="text-sm font-bold leading-none">12</div>
                            <div class="text-xxs font-semibold leading-none text-gray-400">Votes</div>
                        </div>

                        <AppSecondaryButton class="uppercase -mx-5" size="text-xxs" width="w-20" height="h-10">
                            Vote
                        </AppSecondaryButton>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import IdeaAction from '@/Components/Shares/IdeaAction.vue'
import AppSecondaryButton from '@/Components/UI/AppSecondaryButton.vue'
import { Link } from '@inertiajs/inertia-vue3'
import { computed, ref } from 'vue'

const props = defineProps({
    idea: {
        type: Object,
        required: true
    },
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

const ideaUrl = computed(() => props.idea.slug ? `/ideas/${props.idea.slug}` : '')
const ideaLinkRef = ref(null)

defineExpose({
    ideaLinkRef
})
</script>