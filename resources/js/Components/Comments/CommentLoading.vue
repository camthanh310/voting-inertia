<template>
    <IdeaLoading
        :has-vote="false"
        card-footer-class="items-center"
    >
            <template #tag>
            <div class="text-transparent bg-slate-200 h-6">
                John Doe
            </div>
            <div>&bull;</div>
            <div class="text-transparent bg-slate-200 h-6">10 hours ago</div>
        </template>
    </IdeaLoading>
</template>

<script setup>
import IdeaLoading from '@/Components/Shares/IdeaLoading.vue'
</script>
