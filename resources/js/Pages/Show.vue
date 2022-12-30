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

        <div class="idea-container bg-white rounded-xl flex mt-4">
            <div class="flex flex-1 px-4 py-6">
                <div class="flex-none">
                    <a href="#" class="flex-none">
                        <img src="https://source.unsplash.com/200x200/?face&crop=face&v=1" alt="avatar" class="w-14 h-14 rounded-xl">
                    </a>
                </div>

                <div class="w-full mx-4">
                    <h4 class="text-xl font-semibold">
                        <a href="#" class="hover:underline">A random title can go here</a>
                    </h4>

                    <div class="text-gray-600 mt-3">
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Facilis officiis unde nulla eos harum veniam nam animi qui commodi, mollitia aspernatur dolor ipsa aperiam, neque rerum magnam eligendi vel temporibus officia accusantium possimus. Rem, quas. Quas sequi neque cupiditate, nemo error, explicabo veritatis enim non repudiandae voluptatum sunt magnam ipsa eos quisquam debitis ipsum nostrum quae praesentium exercitationem porro dolores. Perspiciatis quidem id, necessitatibus molestiae nam modi perferendis, qui enim debitis numquam sapiente quo nihil! Consectetur incidunt ad laborum odit! Aspernatur voluptatum voluptas quidem labore veritatis, modi odio consectetur sit dolore pariatur recusandae sequi ex natus maiores! Hic, est! Quidem.
                    </div>

                    <div class="flex items-center justify-between mt-6">
                        <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2">
                            <div class="font-bold text-gray-900">John Doe</div>
                            <div>&bull;</div>
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

                                <ul class="hidden absolute w-44 font-semibold text-left bg-white shadow-lg rounded-xl py-3 ml-8 hover:shadow-dialog">
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
        </div> <!-- end idea-container  -->

        <div class="buttons-container flex items-center justify-between mt-6">
            <div class="flex items-center space-x-4 ml-6">
                <div class="relative">
                    <button type="submit" class="flex items-center justify-center h-11 w-32 text-sm bg-blue text-white font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3">
                        Reply
                    </button>

                    <div class="hidden absolute z-10 w-104 text-left font-semibold text-sm bg-white shadow-dialog rounded-xl mt-2">
                        <form action="#" class="space-y-4 px-4 py-6">
                            <div>
                                <textarea
                                    id="post-comment"
                                    cols="30"
                                    rows="4"
                                    class="w-full text-sm bg-gray-100 rounded-xl placeholder-gray-900 border-none px-4 py-2"
                                    placeholder="Go ahead, don't be shy. Share your thoughts ..."
                                ></textarea>
                            </div>

                            <div class="flex items-center space-x-3">
                                <button type="submit" class="flex items-center justify-center h-11 w-1/2 text-sm bg-blue text-white font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3">
                                    Post Comment
                                </button>
                                <button type="button" class="flex items-center justify-center w-32 h-11 text-xs bg-gray-200 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3">
                                    <PaperClipIcon class="tex-gray-600 w-4 h-4 transform -rotate-45" />
                                    <span class="ml-1">Attach</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="relative">
                    <button type="button" class="flex items-center justify-center h-11 w-36 text-sm bg-gray-200 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3">
                        <span>Set Status</span>
                        <ChevronDownIcon class="w-4 h-4 ml-2" />
                    </button>

                    <div class="hidden absolute z-20 w-76 text-left font-semibold text-sm bg-white shadow-dialog rounded-xl mt-2">
                        <form action="#" class="space-y-4 px-4 py-6">
                            <div class="space-y-2">
                                <div>
                                    <label class="inline-flex items-center">
                                        <input class="form-radio bg-gray-200 text-gray-600 border-none" type="radio" checked="" name="radio-direct" value="1">
                                        <span class="ml-2">Open</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex items-center">
                                        <input class="form-radio bg-gray-200 text-purple border-none" type="radio" name="radio-direct" value="2">
                                        <span class="ml-2">Considering</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex items-center">
                                        <input class="form-radio bg-gray-200 text-yellow border-none" type="radio" name="radio-direct" value="3">
                                        <span class="ml-2">In Progress</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex items-center">
                                        <input class="form-radio bg-gray-200 text-green border-none" type="radio" name="radio-direct" value="3">
                                        <span class="ml-2">Implemented</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex items-center">
                                        <input class="form-radio bg-gray-200 text-red border-none" type="radio" name="radio-direct" value="3">
                                        <span class="ml-2">Closed</span>
                                    </label>
                                </div>
                            </div>

                            <div>
                                <textarea
                                    id="update-comments"
                                    cols="30"
                                    rows="3"
                                    class="w-full text-sm bg-gray-100 rounded-xl placeholder-gray-900 border-none px-4 py-2"
                                    placeholder="Add an update comment (optional)"
                                ></textarea>
                            </div>

                            <div class="flex items-center justify-between space-x-3">
                                <button type="button" class="flex items-center justify-center w-1/2 h-11 text-xs bg-gray-200 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3">
                                    <PaperClipIcon class="tex-gray-600 w-4 h-4 transform -rotate-45" />
                                    <span class="ml-1">Attach</span>
                                </button>
                                <button type="submit" class="flex items-center justify-center w-1/2 h-11 text-xs bg-blue text-white font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3">
                                    <span>Update</span>
                                </button>
                            </div>

                            <div>
                                <label class="font-normal inline-flex items-center">
                                    <input class="form-checkbox rounded bg-gray-200" type="checkbox" checked="" id="notify-voters">
                                    <span class="ml-2">Notify all voters</span>
                                </label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="flex items-center space-x-3">
                <div class="bg-white font-semibold text-center rounded-xl px-3 py-2">
                    <div class="text-xl leading-snug">12</div>
                    <div class="text-gray-400 text-xs leading-none">Votes</div>
                </div>

                <button type="button" class="h-11 w-32 uppercase text-xs bg-gray-200 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3">
                    <span>Vote</span>
                </button>
            </div>
        </div> <!-- end buttons-container  -->

        <div class="comments-container relative space-y-6 ml-22 pt-4 my-8 mt-1 before:absolute before:block before:top-0 before:-left-10 before:content-[''] before:w-0.7 before:h-full before:bg-gray-lighter">

            <div
                v-for="idea in ideas"
                :key="idea.id"
                class="bg-white rounded-xl flex mt-4 relative before:absolute before:block before:top-[57px] before:content-[''] last:after:absolute last:after:block last:after:top-[60px] last:after:-left-10 last:after:content-[''] last:after:w-0.7 last:after:h-[calc(100%-60px)] last:after:bg-gray-background"
                :class="[
                    idea.is_admin
                        ? 'before:w-9.5 before:h-9.5 before:rounded-full before:border-8 before:border-white before:bg-purple before:opacity-100 before:-left-[58px] before:shadow-card is-admin'
                        : 'before:w-[23px] before:h-0.7 before:bg-gray-lighter before:-left-10'
                ]"
            >
                <div class="flex flex-1 px-4 py-6">
                    <div class="flex-none">
                        <a href="#" class="flex-none">
                            <img
                                :src="`https://source.unsplash.com/200x200/?face&crop=face&v=${idea.id}`"
                                alt="avatar"
                                class="w-14 h-14 rounded-xl"
                            >
                        </a>
                    </div>

                    <div class="w-full mx-4">
                        <h4 class="text-xl font-semibold" v-if="idea.is_admin">
                            <a href="#" class="hover:underline">Status Changed to "Under Consideration"</a>
                        </h4>

                        <div class="text-gray-600 mt-3"> <!-- line-clamp-3 -->
                            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Facilis officiis unde nulla eos harum veniam nam animi qui commodi, mollitia aspernatur dolor ipsa aperiam, neque rerum magnam eligendi vel temporibus officia accusantium possimus. Rem, quas. Quas sequi neque cupiditate, nemo error, explicabo veritatis enim non repudiandae voluptatum sunt magnam ipsa eos quisquam debitis ipsum nostrum quae praesentium exercitationem porro dolores. Perspiciatis quidem id, necessitatibus molestiae nam modi perferendis, qui enim debitis numquam sapiente quo nihil! Consectetur incidunt ad laborum odit! Aspernatur voluptatum voluptas quidem labore veritatis, modi odio consectetur sit dolore pariatur recusandae sequi ex natus maiores! Hic, est! Quidem.
                        </div>

                        <div class="flex items-center justify-between mt-6">
                            <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2">
                                <div
                                    class="font-bold"
                                    :class="[idea.is_admin ? 'text-blue' : 'text-gray-900']"
                                >
                                    {{ idea.user }}
                                </div>
                                <div>&bull;</div>
                                <div>10 hours ago</div>
                            </div>

                            <div class="flex items-center space-x-2">
                                <button class="relative bg-gray-100 hover:bg-gray-200 border rounded-full h-7 transition duration-150 ease-in py-2 px-3">
                                    <svg fill="currentColor" width="24" height="6">
                                        <path d="M2.97.061A2.969 2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 10-.003 5.94A2.97 2.97 0 0021.03.06z" style="color: rgba(163, 163, 163, .5)" />
                                    </svg>

                                    <ul class="hidden absolute w-44 font-semibold text-left bg-white shadow-lg rounded-xl py-3 ml-8 hover:shadow-dialog">
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


        </div> <!-- end comments-container  -->
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { PaperClipIcon } from '@heroicons/vue/20/solid';
import { ChevronDownIcon } from '@heroicons/vue/24/outline'

const ideas = [
    { id: 1, user: 'John Doe', is_admin: false },
    { id: 2, user: 'James Doe', is_admin: true },
    { id: 3, user: 'Nick Doe', is_admin: false },
]
</script>