<template>
    <ul role="list" class="divide-y divide-gray-100 overflow-hidden bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl">
        <li v-for="member in members" :key="member.email" class="relative flex justify-between gap-x-6 px-4 py-5 hover:bg-gray-50 sm:px-6">
            <div class="flex min-w-0 gap-x-4">
                <img class="h-12 w-12 flex-none rounded-full bg-gray-50" :src="member.avatar" alt="" />
                <div class="min-w-0 flex-auto">
                    <p class="text-sm font-semibold leading-6 text-gray-900">
                        <Link :href="route('users.meetings.show', member.id)">
                            <span class="absolute inset-x-0 -top-px bottom-0" />
                            {{ member.name }}
                        </Link>
                    </p>
                    <p class="mt-1 flex text-xs leading-5 text-gray-500">
                        <a :href="`mailto:${member.email}`" class="relative truncate hover:underline">{{ member.email }}</a>
                    </p>
                </div>
            </div>
            <div class="flex shrink-0 items-center gap-x-4">
                <div class="hidden sm:flex sm:flex-col sm:items-end">
                    <p class="text-sm leading-6 text-gray-900">Member</p>
                    <div class="mt-1 flex items-center gap-x-1.5">
                        <div class="flex-none rounded-full bg-emerald-500/20 p-1">
                            <div class="h-1.5 w-1.5 rounded-full bg-emerald-500" />
                        </div>
                        <p class="text-xs leading-5 text-gray-500">Online</p>
                    </div>
                </div>
                <ChevronRightIcon class="h-5 w-5 flex-none text-gray-400" aria-hidden="true" />
            </div>
        </li>
    </ul>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import { ChevronRightIcon } from '@heroicons/vue/20/solid'

defineProps({
    members: Array
})
</script>
