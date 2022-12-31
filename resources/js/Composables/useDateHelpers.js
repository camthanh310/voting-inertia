import dayjs from 'dayjs'
import { computed } from 'vue'
import relativeTime from 'dayjs/plugin/relativeTime'

dayjs.extend(relativeTime)

export function useDateHelpers() {
    function isValid(date) {
        return dayjs(date).isValid()
    }
    const diffForHumans = computed(() => (date) => {
        if (isValid(date)) {
            return dayjs(date).fromNow()
        }

        return date
    })

    return {
        diffForHumans
    }
}