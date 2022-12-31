<template>
    <div class="relative space-y-6 md:ml-22 pt-4 my-8 mt-1 before:absolute before:block before:top-0 before:-left-10 before:content-[''] before:w-0.7 before:h-full before:bg-gray-lighter">
        <Comment
            v-for="idea in ideas"
            :key="idea.id"
            :idea="idea"
        />
    </div>
</template>

<script setup>
import Comment from '@/Components/Comments/Comment.vue'

const ideas = [
    { id: 1, user: 'John Doe', is_admin: false, description: 'hello world' },
    { id: 2, user: 'James Doe', is_admin: true, description: 'good job' },
    { id: 3, user: 'Nick Doe', is_admin: false, description: 'Nice!!' },
]
</script>