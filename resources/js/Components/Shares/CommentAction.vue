<template>
    <Popover class="relative">
        <PopoverButton
            esc
            class="bg-gray-100 hover:bg-gray-200 border rounded-full h-7 transition duration-150 ease-in py-2 px-3"
        >
            <svg fill="currentColor" width="24" height="6">
                <path d="M2.97.061A2.969 2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 10-.003 5.94A2.97 2.97 0 0021.03.06z" style="color: rgba(163, 163, 163, .5)" />
            </svg>
        </PopoverButton>

        <AppPopperTransition>
            <PopoverPanel as="ul" class="absolute z-10 w-44 font-semibold text-left bg-white shadow-lg rounded-xl py-3 ml-8 hover:shadow-dialog">
                <li>
                    <a href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Mark as Spam</a>
                </li>
                <li>
                    <a href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Delete Post</a>
                </li>
            </PopoverPanel>

        </AppPopperTransition>
    </Popover>
</template>

<script setup>
import { Popover, PopoverButton, PopoverPanel } from '@headlessui/vue'
import AppPopperTransition from '@/Components/UI/AppPopperTransition.vue'
</script>