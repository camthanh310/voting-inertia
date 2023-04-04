<template>
  <AppLayout title="Home">
    <div class="fliters flex flex-col md:flex-row space-y-3 md:space-y-0 md:space-x-6">
      <div class="w-full md:w-1/3">
        <CategoryDropdown v-model="category">
          <option value="">All Categories</option>
        </CategoryDropdown>
      </div>

      <div class="w-1/3">
        <AppSelect id="other-filters" v-model="otherFilter">
          <option value="">No Filter</option>
          <option value="top_voted">Top Voted</option>
          <option value="my_ideas">My Ideas</option>
        </AppSelect>
      </div>

      <div class="w-full md:w-2/3 relative">
        <AppInput size="" type="search" placeholder="Find an idea" class="pl-8" bg-color="bg-white" />

        <div class="absolute top-0 flex items-center h-full ml-2">
          <MagnifyingGlassIcon class="w-4 h-4 text-gray-700" />
        </div>
      </div>
    </div> <!-- end filters -->

    <div class="space-y-6 my-6">
      <template v-if="completed">
        <IdeaCard v-for="(idea, index) in ideasList" :key="idea.id" :idea="idea"
          class="hover:shadow-card transition duration-150 ease-in cursor-pointer" ref="ideaLinksRef"
          @click="linkToIdea($event, index)">
          <template #left-panel>
            <div class="hidden md:block border-r border-gray-100 px-5 py-8">
              <div class="text-center">
                <div class="font-semibold text-2xl" :class="{ 'text-blue': idea.has_voted }">
                  {{ idea.votes_count }}
                </div>
                <div class="text-gray-500">Votes</div>
              </div>
              <div class="mt-8">
                <IdeaVote custom-classes="uppercase font-bold" height="" size="text-xxs" width="w-20" padding-x="px-4"
                  :idea="idea" />
              </div>
            </div>
          </template>
          <template #tag="{ idea }">
            <div>{{ diffForHumans(idea.created_at) }}</div>
            <div>&bull;</div>
            <div>{{ idea.category.name }}</div>
            <div>&bull;</div>
            <div class="text-gray-900">3 Comments</div>
          </template>
          <template #action="{ idea }">
            <IdeaStatus :idea="idea" />
          </template>
        </IdeaCard>
        <AppPagination class="my-8" :next-page-url="nextPageUrl" :prev-page-url="prevPageUrl" @on-next-page="nextPage"
          @on-prev-page="prevPage" />
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
import AppSelect from '@/Components/UI/AppSelect.vue'
import { useDateHelpers } from '@/Composables/useDateHelpers'
import AppLayout from '@/Layouts/AppLayout.vue'
import IdeaLoading from '@/Components/Shares/IdeaLoading.vue'
import { MagnifyingGlassIcon } from '@heroicons/vue/24/solid'
import { computed, nextTick, onMounted, onUnmounted, ref, watch } from 'vue'
import { usePage } from '@inertiajs/vue3'
import IdeaStatus from '@/Components/Shares/IdeaStatus.vue'
import CategoryDropdown from '@/Components/Shares/CategoryDropdown.vue'
import IdeaVote from '@/Components/Shares/IdeaVote.vue'
import { useIdea } from '@/Composables/useIdea'

const props = defineProps({
  ideas: {
    type: Object,
    default: () => ({})
  }
})

const ideasList = computed(() => props.ideas.data)
const nextPageUrl = computed(() => props.ideas.links.next)
const prevPageUrl = computed(() => props.ideas.links.prev)

const { diffForHumans } = useDateHelpers()

const defaultUrl = computed(() => usePage().url || route('idea.index'))
const defaultQuery = computed(() => usePage().props.query)

const url = ref(defaultUrl.value)

const { queryString, loadIdea, completed } = useIdea()

function nextPage(nextUrl) {
  url.value = nextUrl
  loadIdea({ url: url.value, data: queryString })
}

function prevPage(prevUrl) {
  url.value = prevUrl
  loadIdea({ url: url.value, data: queryString })
}

const ideaLinksRef = ref([])
function linkToIdea(event, index) {
  const target = event.target.tagName.toLowerCase()
  const ignores = ['button', 'svg', 'path', 'a']
  if (!ignores.includes(target)) {
    ideaLinksRef.value[index].ideaLinkRef.$el.click()
  }
}

const category = ref('')

const otherFilter = ref('')

watch(
  () => otherFilter.value,
  (otherFilter) => {
    console.log('good job');
    if (otherFilter === 'top_voted') {
      queryString.sort = otherFilter
      queryString.filter.my_ideas = ''
    } else if (otherFilter === 'my_ideas') {
      queryString.filter.my_ideas = otherFilter
      queryString.sort = ''
    } else {
      queryString.filter.my_ideas = ''
      queryString.sort = ''
    }

    loadIdea({ url: url.value, data: queryString })
  }
)

watch(
  () => category.value,
  (categoryId) => {
    queryString.filter.category_id = categoryId
    loadIdea({ url: url.value, data: queryString })
  }
)

async function fetchIdea() {
  queryString.filter.status_id = +defaultQuery.value.filter.status_id || ''
  queryString.filter.category_id = +defaultQuery.value.filter.category_id || ''
  queryString.filter.my_ideas = defaultQuery.value.filter.my_ideas
  queryString.sort = defaultQuery.value.sort

  category.value = queryString.filter.category_id

  if (queryString.sort === 'top_voted') {
    otherFilter.value = queryString.sort
  } else if (queryString.filter.my_ideas === 'my_ideas') {
    otherFilter.value = queryString.filter.my_ideas
  }

  await nextTick()

  loadIdea({ url: url.value, data: queryString })
}

function clearQueryString() {
  queryString.filter.status_id = ''
  queryString.filter.category_id = ''
  queryString.filter.my_ideas = ''
  queryString.sort = ''
}

onMounted(() => {
  fetchIdea()
})

onUnmounted(() => {
  clearQueryString()
})
</script>