<template>
    <Popover class="relative">
        <PopoverButton
            :as="AppSecondaryButton"
            width="w-36"
            size="text-sm"
            flex
        >
            <span>Set Status</span>
            <ChevronDownIcon class="w-4 h-4 ml-2" />
        </PopoverButton>

        <AppPopperTransition>
            <PopoverPanel class="absolute z-20 w-64 md:w-76 text-left font-semibold text-sm bg-white shadow-dialog rounded-xl mt-2">
                <AppForm>
                    <div class="space-y-2">
                        <div v-for="option in options" :key=option.value>
                            <AppRadio
                                name="option-radio"
                                :value="option.value"
                                :label="option.text"
                                :color="option.color"
                            />
                        </div>
                    </div>

                    <div>
                        <AppTextarea id="update-comments" placeholder="Add an update comment (optional)" />
                    </div>

                    <div class="flex items-center justify-between space-x-3">
                        <AppSecondaryButton flex type="button">
                            <AppPaperClipIcon />
                            <span class="ml-1">Attach</span>
                        </AppSecondaryButton>

                        <AppPrimaryButton type="submit">
                            Update
                        </AppPrimaryButton>
                    </div>

                    <div>
                        <AppCheckbox label="Notify all voters" />
                    </div>
                </AppForm>
            </PopoverPanel>
        </AppPopperTransition>
    </Popover>
</template>

<script setup>
import { Popover, PopoverButton, PopoverPanel } from '@headlessui/vue'
import AppSecondaryButton from '@/Components/UI/AppSecondaryButton.vue'
import { ChevronDownIcon } from '@heroicons/vue/24/solid'
import AppPopperTransition from '@/Components/UI/AppPopperTransition.vue'
import AppForm from '@/Components/UI/AppForm.vue'
import AppTextarea from '@/Components/UI/AppTextarea.vue'
import AppPrimaryButton from '@/Components/UI/AppPrimaryButton.vue'
import AppPaperClipIcon from '@/Components/UI/AppPaperClipIcon.vue'
import AppCheckbox from '@/Components/UI/AppCheckbox.vue'
import AppRadio from '../UI/AppRadio.vue'

const options = [
    { text: 'Open', color: 'text-gray-600', value: 1 },
    { text: 'Considering', color: 'text-purple', value: 2 },
    { text: 'In Progress', color: 'text-yellow', value: 3 },
    { text: 'Implemented', color: 'text-green', value: 4 },
    { text: 'Closed', color: 'text-red', value: 5 },
]
</script>