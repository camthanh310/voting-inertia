export function useSetupForm(props, emit) {
    function updateValue(event) {
        let value = event.target.value

        if (event.target.type === 'checkbox') {
            value = event.target.checked
        }

        if (event.target.type === 'radio') {
            value = props.value
        }

        emit('update:modelValue', value)
    }

    return { updateValue }
}

