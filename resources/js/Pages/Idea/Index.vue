<template>
    <AppLayout title="Home">
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
            <template v-if="completed">
                <IdeaCard
                    v-for="(idea, index) in ideasList"
                    :key="idea.id"
                    :idea="idea"
                    class="hover:shadow-card transition duration-150 ease-in cursor-pointer"
                    ref="ideaLinksRef"
                    @click="linkToIdea($event, index)"
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
                    <template #tag="{ idea }">
                        <div>{{ diffForHumans(idea.created_at) }}</div>
                        <div>&bull;</div>
                        <div>Category 1</div>
                        <div>&bull;</div>
                        <div class="text-gray-900">3 Comments</div>
                    </template>
                    <template #action>
                        <div class="bg-gray-200 text-xxs font-bold uppercase leading-none rounded-full text-center w-28 h-7 py-2 px-4">Open</div>
                    </template>
                </IdeaCard>
                <AppPagination
                    class="my-8"
                    :next-page-url="nextPageUrl"
                    :prev-page-url="prevPageUrl"
                    @on-next-page="nextPage"
                    @on-prev-page="prevPage"
                />
            </template>

            <template v-else>
                <IdeaLoading v-for="n in 8" :key="n">
                    <template #left-panel>
                        <div class="hidden md:block border-r border-gray-100 px-5 py-8">
                            <div class="text-center">
                                <div class="font-semibold text-2xl">
                                    <span class="bg-slate-200 p-1 text-transparent rounded-sm">12</span>
                                </div>
                                <div class="text-gray-500 mt-4">
                                    <span class="bg-slate-200 p-1 text-transparent rounded-sm">Votes</span>
                                </div>
                            </div>
                            <div class="mt-8">
                                <div class="w-20 px-4 font-bold text-center bg-slate-200 py-3 h-10 rounded-xl text-transparent">
                                    Vote
                                </div>
                            </div>
                        </div>
                    </template>
                </IdeaLoading>
            </template>
        </div>
    </AppLayout>
</template>

<script setup>
import IdeaCard from '@/Components/Shares/IdeaCard.vue'
import AppInput from '@/Components/UI/AppInput.vue'
import AppPagination from '@/Components/UI/AppPagination.vue'
import AppSecondaryButton from '@/Components/UI/AppSecondaryButton.vue'
import AppSelect from '@/Components/UI/AppSelect.vue'
import { useDateHelpers } from '@/Composables/useDateHelpers'
import AppLayout from '@/Layouts/AppLayout.vue'
import IdeaLoading from '@/Components/Shares/IdeaLoading.vue'
import { MagnifyingGlassIcon } from '@heroicons/vue/24/solid'
import { computed, onMounted, ref } from 'vue'
import { Inertia } from '@inertiajs/inertia'

const props = defineProps({
    ideas: {
        type: Object,
        default: () => ({})
    }
})

const ideasList = computed(() => props.ideas.data)
const nextPageUrl = computed(() => props.ideas.next_page_url)
const prevPageUrl = computed(() => props.ideas.prev_page_url)

const { diffForHumans } = useDateHelpers()

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

const completed = ref(false)
const url = ref(route('idea.index'))

function loadIdea() {
    Inertia.visit(
        url.value,
        {
            method: 'get',
            preserveState: true,
            onBefore: visit => {
                completed.value = visit.completed
            },
            onError: errors => {
                console.log('onError', errors);
            },
            onFinish: visit => {
                completed.value = visit.completed
            },
        }
    )
}

function nextPage(nextUrl) {
    url.value = nextUrl
    loadIdea()
}

function prevPage(prevUrl) {
    url.value = prevUrl
    loadIdea()
}

const ideaLinksRef = ref([])
function linkToIdea(event, index) {
    const target = event.target.tagName.toLowerCase()
    const ignores = ['button', 'svg', 'path', 'a']
    if (!ignores.includes(target)) {
        ideaLinksRef.value[index].ideaLinkRef.$el.click()
    }
}

onMounted(() => {
    loadIdea()
})
</script>