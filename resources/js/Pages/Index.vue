<template>
    <AppLayout>
        <div class="fliters flex space-x-6">
            <div class="w-1/3">
                <select id="category" class="w-full rounded-xl border-none px-4 py-2">
                    <option value="category 1">Category One</option>
                    <option value="category 1">Category One</option>
                    <option value="category 1">Category One</option>
                    <option value="category 1">Category One</option>
                </select>
            </div>

            <div class="w-1/3">
                <select id="other-filters" class="w-full rounded-xl border-none px-4 py-2">
                    <option value="Category 1">Filter One</option>
                    <option value="Category 1">Category One</option>
                    <option value="Category 1">Category One</option>
                    <option value="Category 1">Category One</option>
                </select>
            </div>

            <div class="w-2/3 relative">
                <input type="search" placeholder="Find an idea" class="w-full rounded-xl bg-white border-none placeholder-gray-800 px-4 py-2 pl-8" />
                <div class="absolute top-0 flex items-center h-full ml-2">
                    <MagnifyingGlassIcon class="w-4 h-4 text-gray-700" />
                </div>
            </div>
        </div>  <!-- end filters -->

        <div class="ideas-container space-y-6 my-6">
            <div class="idea-container hover:shadow-card transition duration-150 ease-in bg-white rounded-xl flex cursor-pointer">
                <div class="border-r border-gray-100 px-5 py-8">
                    <div class="text-center">
                        <div class="font-semibold text-2xl">12</div>
                        <div class="text-gray-500">Votes</div>
                    </div>

                    <div class="mt-8">
                        <button class="w-20 bg-gray-200 border border-gray-200 hover:border-gray-400 font-bold text-xxs uppercase rounded-xl transition duration-150 ease-in px-4 py-3">
                            Vote
                        </button>
                    </div>
                </div>

                <div class="flex flex-1 px-2 py-6">
                    <div class="flex-none">
                        <a href="#" class="flex-none">
                            <img src="https://source.unsplash.com/200x200/?face&crop=face&v=1" alt="avatar" class="w-14 h-14 rounded-xl">
                        </a>
                    </div>

                    <div class="w-full mx-4">
                        <h4 class="text-xl font-semibold">
                            <a href="#" class="hover:underline">A random title can go here</a>
                        </h4>

                        <div class="text-gray-600 mt-3 line-clamp-3">
                            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Facilis officiis unde nulla eos harum veniam nam animi qui commodi, mollitia aspernatur dolor ipsa aperiam, neque rerum magnam eligendi vel temporibus officia accusantium possimus. Rem, quas. Quas sequi neque cupiditate, nemo error, explicabo veritatis enim non repudiandae voluptatum sunt magnam ipsa eos quisquam debitis ipsum nostrum quae praesentium exercitationem porro dolores. Perspiciatis quidem id, necessitatibus molestiae nam modi perferendis, qui enim debitis numquam sapiente quo nihil! Consectetur incidunt ad laborum odit! Aspernatur voluptatum voluptas quidem labore veritatis, modi odio consectetur sit dolore pariatur recusandae sequi ex natus maiores! Hic, est! Quidem.
                        </div>

                        <div class="flex items-center justify-between mt-6">
                            <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2">
                                <div>10 hours ago</div>
                                <div>&bull;</div>
                                <div>Category 1</div>
                                <div>&bull;</div>
                                <div class="text-gray-900">3 Comments</div>
                            </div>

                            <div class="flex items-center space-x-2">
                                <div class="bg-gray-200 text-xxs font-bold uppercase leading-none rounded-full text-center w-28 h-7 py-2 px-4">Open</div>
                                <button class="relative bg-gray-100 hover:bg-gray-200 border rounded-full h-7 transition duration-150 ease-in py-2 px-3">
                                    <svg fill="currentColor" width="24" height="6">
                                        <path d="M2.97.061A2.969 2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 10-.003 5.94A2.97 2.97 0 0021.03.06z" style="color: rgba(163, 163, 163, .5)" />
                                    </svg>

                                    <ul class="absolute w-44 font-semibold text-left bg-white shadow-lg rounded-xl py-3 ml-8 hover:shadow-dialog">
                                        <li>
                                            <a href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Mark as Spam</a>
                                        </li>
                                        <li>
                                            <a href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Delete Post</a>
                                        </li>
                                    </ul>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { MagnifyingGlassIcon } from '@heroicons/vue/24/solid'
</script>