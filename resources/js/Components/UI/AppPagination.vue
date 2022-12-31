<template>
   <div class="flex flex-1 justify-between">
        <component
            :is="prevPageUrl ? Link : 'span'"
            :href="prevPageUrl"
            class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
            :class="{ 'opacity-50 cursor-not-allowed': !prevPageUrl }"
        >
            <ChevronDoubleLeftIcon class="w-4 h-4 mr-2" />
            <span>Previous</span>
        </component>

        <component
            :is="nextPageUrl ? Link : 'span'"
            :href="nextPageUrl"
            class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
            :class="{ 'opacity-50 cursor-not-allowed': !nextPageUrl }"
        >
            <span>Next</span>
            <ChevronDoubleRightIcon class="w-4 h-4 ml-2" />
        </component>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3'
import { ChevronDoubleLeftIcon, ChevronDoubleRightIcon } from '@heroicons/vue/20/solid'

defineProps({
    nextPageUrl: {
        type: String,
        default: null
    },
    prevPageUrl: {
        type: String,
        default: null
    }
})
</script>