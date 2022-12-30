<template>
    <AppLayout>
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
            <template #tag>
                <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2">
                    <div class="font-bold text-gray-900">John Doe</div>
                    <div>&bull;</div>
                    <div>10 hours ago</div>
                    <div>&bull;</div>
                    <div>Category 1</div>
                    <div>&bull;</div>
                    <div class="text-gray-900">3 Comments</div>
                </div>
            </template>
        </IdeaCard>

        <div class="buttons-container flex items-center justify-between mt-6">
            <div class="flex items-center space-x-4 ml-6">
                <Reply />
                <SetStatus />
            </div>

            <div class="flex items-center space-x-3">
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

const idea = {
    id: 1,
    title: 'A random title can go here',
    description: 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Facilis officiis unde nulla eos harum veniam nam animi qui commodi, mollitia aspernatur dolor ipsa aperiam, neque rerum magnam eligendi vel temporibus officia accusantium possimus. Rem, quas. Quas sequi neque cupiditate, nemo error, explicabo veritatis enim non repudiandae voluptatum sunt magnam ipsa eos quisquam debitis ipsum nostrum quae praesentium exercitationem porro dolores. Perspiciatis quidem id, necessitatibus molestiae nam modi perferendis, qui enim debitis numquam sapiente quo nihil! Consectetur incidunt ad laborum odit! Aspernatur voluptatum voluptas quidem labore veritatis, modi odio consectetur sit dolore pariatur recusandae sequi ex natus maiores! Hic, est! Quidem.',
}
</script>