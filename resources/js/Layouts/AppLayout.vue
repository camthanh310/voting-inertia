<template>
    <header class="flex items-center justify-between px-8 py-4">
        <a href="#">
            <ApplicationLogo />
        </a>

        <div class="flex items-center">
            <!-- v-if has route login -->
            <div v-if="canLogin" class="px-6 py-4">
                <!-- v-if auth -->
                <a href="#" v-if="authUser">
                    Logout
                </a>
                <!-- v-else -->
                <a href="#" class="text-sm text-gray-700 dark:text-gray-500 underline" v-else>
                    Log in
                </a>

                <!-- v-if has route register -->
                <a href="#" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline" v-if="canRegister">
                    Register
                </a>
            </div>
            <a href="#">
                <img src="https://www.gravatar.com/avatar/00000000000000000000000000000000?d=mp" alt="avatar" class="w-10 h-10 rounded-full">
            </a>
        </div>
    </header>

    <main class="container mx-auto max-w-custom flex">
        <div class="w-70 mr-5">
            <div
                class="bg-white border-2 border-blue rounded-xl mt-16"
                style="
                    border-image-source: linear-gradient(to bottom, rgba(50, 138, 241, 0.22), rgba(99, 123, 255, 0));
                    border-image-slice: 1;
                    background-image: linear-gradient(to bottom, #ffffff, #ffffff), linear-gradient(to bottom, rgba(50, 138, 241, 0.22), rgba(99, 123, 255, 0));
                    background-origin: border-box;
                    background-clip: content-box, border-box;
                "
            >
                <div class="text-center px-6 py-2 pt-6">
                    <h3 class="font-semibold text-base">Add an idea</h3>
                    <p class="text-xs mt-4">
                        Let us know what you would like and we'll take a look over!
                    </p>
                </div>

                <form action="#" class="space-y-4 px-4 py-6">
                    <div>
                        <input type="text" class="w-full text-sm bg-gray-100 border-none rounded-xl placeholder-gray-900 px-4 py-2" placeholder="Your Idea">
                    </div>
                    <div>
                        <select id="category-add" class="w-full bg-gray-100 text-sm rounded-xl border-none px-4 py-2">
                            <option value="category 1">Category One</option>
                            <option value="category 1">Category One</option>
                            <option value="category 1">Category One</option>
                            <option value="category 1">Category One</option>
                        </select>
                    </div>
                    <div>
                        <textarea id="idea" cols="30" rows="4" class="w-full bg-gray-100 border-none text-sm rounded-xl placeholder-gray-900 px-4 py-2" placeholder="Describe your idea"></textarea>
                    </div>
                    <div class="flex items-center justify-between space-x-3">
                        <button type="button" class="flex items-center justify-center w-1/2 h-11 text-xs bg-gray-200 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3">
                            <PaperClipIcon class="tex-gray-600 w-4 h-4 transform -rotate-45" />
                            <span class="ml-1">Attach</span>
                        </button>
                        <button type="submit" class="flex items-center justify-center w-1/2 h-11 text-xs bg-blue text-white font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3">
                            <span>Submit</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="w-175">
            <nav class="flex items-center justify-between text-xs">
                <ul class="flex uppercase font-semibold border-b-4 pb-3 space-x-10">
                    <li>
                        <a href="#" class="border-b-4 pb-3 border-blue">All Ideas (87)</a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-400 transition duration-150 ease-in border-b-4 pb-3 hover:border-blue">
                            Considering (8)
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-400 transition duration-150 ease-in border-b-4 pb-3 hover:border-blue">
                            In Progress (1)
                        </a>
                    </li>
                </ul>

                <ul class="flex uppercase font-semibold border-b-4 pb-3 space-x-10">
                    <li>
                        <a href="#" class="text-gray-400 transition duration-150 ease-in border-b-4 pb-3 hover:border-blue">
                            Implemented (10)
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-400 transition duration-150 ease-in border-b-4 pb-3 hover:border-blue">
                            Closed (8)
                        </a>
                    </li>
                </ul>
            </nav>

            <div class="mt-8">
                <slot />
            </div>
        </div>
    </main>
</template>

<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue'
import { computed } from 'vue'
import { usePage } from '@inertiajs/inertia-vue3'
import { PaperClipIcon } from '@heroicons/vue/20/solid'

const canLogin = computed(() => usePage().props.value.canLogin)
const canRegister = computed(() => usePage().props.value.canRegister)
const authUser = computed(() => usePage().props.value.auth.user)
</script>