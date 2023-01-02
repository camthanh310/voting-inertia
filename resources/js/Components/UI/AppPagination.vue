<template>
   <div class="flex flex-1 justify-between">
        <button
            class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
            @click="prevPage"
            v-if="prevPageUrl"
        >
            <ChevronDoubleLeftIcon class="w-4 h-4 mr-2" />
            <span>Previous</span>
        </button>
        <span
            class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 opacity-50 cursor-not-allowed"
            v-else
        >
            <ChevronDoubleLeftIcon class="w-4 h-4 mr-2" />
            <span>Previous</span>
        </span>

        <button
            class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
            @click="nextPage"
            v-if="nextPageUrl"
        >
            <span>Next</span>
            <ChevronDoubleRightIcon class="w-4 h-4 ml-2" />
        </button>
        <span
            v-else
            class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 opacity-50 cursor-not-allowed"
        >
            <span>Next</span>
            <ChevronDoubleRightIcon class="w-4 h-4 ml-2" />
        </span>
  </div>
</template>

<script setup>
import { ChevronDoubleLeftIcon, ChevronDoubleRightIcon } from '@heroicons/vue/20/solid'

const props = defineProps({
    nextPageUrl: {
        type: String,
        default: null
    },
    prevPageUrl: {
        type: String,
        default: null
    }
})

const emit = defineEmits(['on-next-page', 'on-prev-page'])

function nextPage() {
    emit('on-next-page', props.nextPageUrl)
}

function prevPage() {
    emit('on-prev-page', props.prevPageUrl)
}
</script>