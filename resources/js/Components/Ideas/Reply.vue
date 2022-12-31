<template>
    <Popover class="relative">
        <PopoverButton
            esc
            as="div"
        >
            <AppPrimaryButton width="w-32" size="text-sm">Reply</AppPrimaryButton>
        </PopoverButton>

        <AppPopperTransition>
            <PopoverPanel class="absolute z-10 w-64 md:w-104 text-left font-semibold text-sm bg-white shadow-dialog rounded-xl mt-2">
                <AppForm>
                    <div>
                        <AppTextarea id="post-comment" placeholder="Go ahead, don't be shy. Share your thoughts ..."  />
                    </div>

                    <div class="flex flex-col md:flex-row items-center md:space-x-3">
                        <AppPrimaryButton type="submit" size="text-sm" width="w-full md:w-1/2">
                            Post Comment
                        </AppPrimaryButton>
                        <AppSecondaryButton
                            flex
                            width="w-full md:w-32"
                            class="mt-2 md:mt-0"
                        >
                            <AppPaperClipIcon />
                            <span class="ml-1">Attach</span>
                        </AppSecondaryButton>
                    </div>
                </AppForm>
            </PopoverPanel>

        </AppPopperTransition>
    </Popover>
</template>

<script setup>
import { Popover, PopoverButton, PopoverPanel } from '@headlessui/vue'
import AppPrimaryButton from '@/Components/UI/AppPrimaryButton.vue'
import AppForm from '@/Components/UI/AppForm.vue'
import AppSecondaryButton from '@/Components/UI/AppSecondaryButton.vue'
import AppTextarea from '@/Components/UI/AppTextarea.vue'
import AppPopperTransition from '@/Components/UI/AppPopperTransition.vue'
import AppPaperClipIcon from '@/Components/UI/AppPaperClipIcon.vue'
</script>
