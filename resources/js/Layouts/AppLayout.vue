<template>
    <Head :title="title" />

    <header class="flex flex-col md:flex-row items-center justify-between px-8 py-4">
        <Link :href="route('idea.index')">
            <ApplicationLogo />
        </Link>

        <div class="flex items-center mt-2 md:mt-0">
            <div v-if="canLogin" class="px-6 py-4">
                <template v-if="authUser">
                    <Link :href="route('logout')" method="post" as="button">
                        Logout
                    </Link>
                    <!-- <Link :href="route('profile.edit')">
                        Profile
                    </Link> -->
                </template>

                <template v-else>
                    <Link :href="route('login')" class="text-sm text-gray-700 dark:text-gray-500 underline">
                        Log in
                    </Link>
                    <Link :href="route('register')" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline" v-if="canRegister">
                        Register
                    </Link>
                </template>
            </div>
            <a href="#">
                <img src="https://www.gravatar.com/avatar/00000000000000000000000000000000?d=mp" alt="avatar" class="w-10 h-10 rounded-full">
            </a>
        </div>
    </header>

    <main class="container mx-auto max-w-custom flex flex-col md:flex-row">
        <div class="w-70 mx-auto md:mx-0 md:mr-5">
            <div class="bg-white md:sticky md:top-8 border-2 border-blue rounded-xl mt-16 border-form-idea">
                <div class="text-center px-6 py-2 pt-6">
                    <h3 class="font-semibold text-base">Add an idea</h3>
                    <p class="text-xs mt-4">
                        {{ ideaFormMessage }}
                    </p>
                </div>

                <AppForm v-if="authUser" @submit.prevent="onSubmit">
                    <div>
                        <AppInput placeholder="Your Idea" v-model="ideaForm.title" />
                        <p class="text-red text-xs mt-1" v-if="ideaForm.errors.title">{{ ideaForm.errors.title }}</p>
                    </div>
                    <div>
                        <CategoryDropdown v-model="ideaForm.category_id" classes="bg-gray-100 text-sm" />
                        <p class="text-red text-xs mt-1" v-if="ideaForm.errors.category_id">{{ ideaForm.errors.category_id }}</p>
                    </div>
                    <div>
                        <AppTextarea
                            id="idea"
                            placeholder="Describe your idea"
                            v-model="ideaForm.description"
                        />
                        <p class="text-red text-xs mt-1" v-if="ideaForm.errors.description">{{ ideaForm.errors.description }}</p>
                    </div>
                    <div class="flex items-center justify-between space-x-3">
                        <AppSecondaryButton type="button" flex>
                            <AppPaperClipIcon />
                            <span class="ml-1">Attach</span>
                        </AppSecondaryButton>

                        <AppPrimaryButton type="submit" v-if="!ideaForm.processing">
                            <span>Submit</span>
                        </AppPrimaryButton>
                        <AppPrimaryButton type="submit" v-else as="span">
                            <AppInfiniteLoadingIcon />
                            <span class="ml-1">Submit</span>
                        </AppPrimaryButton>
                    </div>

                    <AppMessage />
                </AppForm>

                <div class="my-6 text-center flex flex-col items-center" v-else>
                    <AppPrimaryButton
                        :tag="Link"
                        :href="route('login')"
                        :flex="false"
                        custom-classes="inline-block"
                    >
                        Login
                    </AppPrimaryButton>

                    <AppSecondaryButton
                        :tag="Link"
                        :href="route('register')"
                        custom-classes="inline-block mt-4"
                    >
                        Sign Up
                    </AppSecondaryButton>
                </div>
            </div>
        </div>

        <div class="w-full px-2 md:px-0 md:w-175">
            <StatusFilters />

            <div class="mt-8">
                <slot />
            </div>
        </div>
    </main>
</template>

<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue'
import { computed } from 'vue'
import { useForm, usePage, Head, Link } from '@inertiajs/vue3'
import AppPrimaryButton from '@/Components/UI/AppPrimaryButton.vue'
import AppSecondaryButton from '@/Components/UI/AppSecondaryButton.vue'
import AppPaperClipIcon from '@/Components/UI/AppPaperClipIcon.vue'
import AppTextarea from '@/Components/UI/AppTextarea.vue'
import AppInput from '@/Components/UI/AppInput.vue'
import AppForm from '@/Components/UI/AppForm.vue'
import AppMessage from '@/Components/UI/AppMessage.vue'
import CategoryDropdown from '@/Components/Shares/CategoryDropdown.vue'
import AppInfiniteLoadingIcon from '@/Components/UI/AppInfiniteLoadingIcon.vue'
import StatusFilters from '@/Layouts/StatusFilters.vue'

const canLogin = computed(() => usePage().props.canLogin)
const canRegister = computed(() => usePage().props.canRegister)
const authUser = computed(() => usePage().props.auth.user)
const ideaFormMessage = computed(() => authUser.value ? 'Let us know what you would like and we\'ll take a look over!' : 'Please login to create an idea.')

const ideaForm = useForm({
    'title': '',
    'category_id': 1,
    'description': ''
})

const props = defineProps({
    title: {
        type: String,
        default: ''
    }
})

function onSubmit() {
    ideaForm.post(
        route('idea.store'),
        {
            onSuccess: () => {
                ideaForm.reset('title')
                ideaForm.reset('description')
                ideaForm.reset('category_id')
            },
            preserveScroll: true
        }
    )
}
</script>