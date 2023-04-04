import { reactive, ref } from "vue";
import { router } from '@inertiajs/vue3'

const queryString = reactive({
  filter: {
      status_id: "",
      category_id: "",
      my_ideas: "",
  },
  sort: "",
});

export function useIdea() {
  const completed = ref(false)

  function loadIdea({ url, data }) {
    const decodeUri = decodeURI(url)
    router.visit(
        decodeUri,
        {
          method: 'get',
          preserveState: true,
          data: data || {},
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

  return {
    queryString,
    completed,
    loadIdea
  }
}
