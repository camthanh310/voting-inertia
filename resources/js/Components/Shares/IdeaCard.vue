<template>
    <div class="bg-white rounded-xl flex">
        <slot name="left-panel" />

        <div class="flex flex-1 px-2 py-6">
            <div class="flex-none">
                <a href="#" class="flex-none">
                    <img :src="`https://source.unsplash.com/200x200/?face&crop=face&v=${idea.id}`" alt="avatar" class="w-14 h-14 rounded-xl">
                </a>
            </div>

            <div class="w-full mx-4">
                <h4 class="text-xl font-semibold" v-if="hasTitle">
                    <a href="#" class="hover:underline">
                        <slot name="title">
                            {{ idea.title }}
                        </slot>
                    </a>
                </h4>

                <div
                    class="text-gray-600 mt-3"
                    :class="{ 'line-clamp-3': limit }"
                >
                    {{ idea.description }}
                </div>

                <div class="flex items-center justify-between mt-6">
                    <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2">
                        <slot name="tag" />
                    </div>

                    <div class="flex items-center space-x-2">
                        <slot name="action" />

                        <CommentAction />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import CommentAction from '@/Components/Shares/CommentAction.vue'

defineProps({
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
    }
})
</script>