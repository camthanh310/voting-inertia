<template>
    <Head :title="title" />

    <header class="flex flex-col md:flex-row items-center justify-between px-8 py-4">
        <Link :href="route('idea.index')">
            <ApplicationLogo />
        </Link>

        <div class="flex items-center mt-2 md:mt-0">
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

    <main class="container mx-auto max-w-custom flex flex-col md:flex-row">
        <div class="w-70 mx-auto md:mx-0 md:mr-5">
            <div
                class="bg-white md:sticky md:top-8 border-2 border-blue rounded-xl mt-16"
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

                <AppForm>
                    <div>
                        <AppInput placeholder="Your Idea" />
                    </div>
                    <div>
                        <AppSelect id="category-add" :options="categories" class="bg-gray-100 text-sm" />
                    </div>
                    <div>
                        <AppTextarea
                            id="idea"
                            placeholder="Describe your idea"
                        />
                    </div>
                    <div class="flex items-center justify-between space-x-3">
                        <AppSecondaryButton type="button" flex>
                            <AppPaperClipIcon />
                            <span class="ml-1">Attach</span>
                        </AppSecondaryButton>

                        <AppPrimaryButton type="submit">
                            <span>Submit</span>
                        </AppPrimaryButton>
                    </div>
                </AppForm>
            </div>
        </div>

        <div class="w-full px-2 md:px-0 md:w-175">
            <nav class="hidden md:flex items-center justify-between text-xs">
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
import AppPrimaryButton from '@/Components/UI/AppPrimaryButton.vue'
import AppSecondaryButton from '@/Components/UI/AppSecondaryButton.vue'
import AppPaperClipIcon from '@/Components/UI/AppPaperClipIcon.vue'
import AppTextarea from '@/Components/UI/AppTextarea.vue'
import AppInput from '@/Components/UI/AppInput.vue'
import AppSelect from '@/Components/UI/AppSelect.vue'
import AppForm from '@/Components/UI/AppForm.vue'
import { Head, Link } from '@inertiajs/inertia-vue3'

const canLogin = computed(() => usePage().props.value.canLogin)
const canRegister = computed(() => usePage().props.value.canRegister)
const authUser = computed(() => usePage().props.value.auth.user)

const categories = [
    'Category One',
    'Category One',
    'Category One',
    'Category One',
]

const props = defineProps({
    title: {
        type: String,
        default: ''
    }
})
</script>