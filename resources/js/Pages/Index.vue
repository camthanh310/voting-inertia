<template>
    <AppLayout>
        <div class="fliters flex flex-col md:flex-row space-y-3 md:space-y-0 md:space-x-6">
            <div class="w-full md:w-1/3">
                <AppSelect id="category" :options="categories" />
            </div>

            <div class="w-1/3">
                <AppSelect id="other-filters" :options="filters" />
            </div>

            <div class="w-full md:w-2/3 relative">
                <AppInput
                    size=""
                    type="search"
                    placeholder="Find an idea"
                    class="pl-8"
                    bg-color="bg-white"
                />

                <div class="absolute top-0 flex items-center h-full ml-2">
                    <MagnifyingGlassIcon class="w-4 h-4 text-gray-700" />
                </div>
            </div>
        </div>  <!-- end filters -->

        <div class="space-y-6 my-6">
            <IdeaCard
                v-for="idea in ideas"
                :key="idea.id"
                :idea="idea"
                class="hover:shadow-card transition duration-150 ease-in cursor-pointer"
            >
                <template #left-panel>
                    <div class="hidden md:block border-r border-gray-100 px-5 py-8">
                        <div class="text-center">
                            <div class="font-semibold text-2xl">12</div>
                            <div class="text-gray-500">Votes</div>
                        </div>

                        <div class="mt-8">
                            <AppSecondaryButton
                                type="button"
                                class="uppercase font-bold"
                                height=""
                                size="text-xxs"
                                width="w-20"
                                padding-x="px-4"
                            >
                                Vote
                            </AppSecondaryButton>
                        </div>
                    </div>
                </template>

                <template #tag>
                    <div>10 hours ago</div>
                    <div>&bull;</div>
                    <div>Category 1</div>
                    <div>&bull;</div>
                    <div class="text-gray-900">3 Comments</div>
                </template>

                <template #action>
                    <div class="bg-gray-200 text-xxs font-bold uppercase leading-none rounded-full text-center w-28 h-7 py-2 px-4">Open</div>
                </template>
            </IdeaCard>
        </div>
    </AppLayout>
</template>

<script setup>
import IdeaCard from '@/Components/Shares/IdeaCard.vue'
import AppInput from '@/Components/UI/AppInput.vue';
import AppSecondaryButton from '@/Components/UI/AppSecondaryButton.vue'
import AppSelect from '@/Components/UI/AppSelect.vue';
import AppLayout from '@/Layouts/AppLayout.vue'
import { MagnifyingGlassIcon } from '@heroicons/vue/24/solid'

const ideas = [
    { id: 1, title: 'A random title can go here', description: 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Facilis officiis unde nulla eos harum veniam nam animi qui commodi, mollitia aspernatur dolor ipsa aperiam, neque rerum magnam eligendi vel temporibus officia accusantium possimus. Rem, quas. Quas sequi neque cupiditate, nemo error, explicabo veritatis enim non repudiandae voluptatum sunt magnam ipsa eos quisquam debitis ipsum nostrum quae praesentium exercitationem porro dolores. Perspiciatis quidem id, necessitatibus molestiae nam modi perferendis, qui enim debitis numquam sapiente quo nihil! Consectetur incidunt ad laborum odit! Aspernatur voluptatum voluptas quidem labore veritatis, modi odio consectetur sit dolore pariatur recusandae sequi ex natus maiores! Hic, est! Quidem.' },
    { id: 2, title: 'A random title 2', description: 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Facilis officiis unde nulla eos harum veniam nam animi qui commodi, mollitia aspernatur dolor ipsa aperiam, neque rerum magnam eligendi vel temporibus officia accusantium possimus. Rem, quas. Quas sequi neque cupiditate, nemo error, explicabo veritatis enim non repudiandae voluptatum sunt magnam ipsa eos quisquam debitis ipsum nostrum quae praesentium exercitationem porro dolores. Perspiciatis quidem id, necessitatibus molestiae nam modi perferendis, qui enim debitis numquam sapiente quo nihil! Consectetur incidunt ad laborum odit! Aspernatur voluptatum voluptas quidem labore veritatis, modi odio consectetur sit dolore pariatur recusandae sequi ex natus maiores! Hic, est! Quidem.' }
]

const categories = [
    'Category One',
    'Category One',
    'Category One',
    'Category One',
]

const filters = [
    'Filter One',
    'Category One',
    'Category One',
    'Category One',
]
</script>