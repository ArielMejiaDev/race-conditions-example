<template>
    <div>
        <h2 class="text-sm font-medium text-gray-500">Meetings</h2>
        <ul role="list" class="mt-3 grid grid-cols-1 gap-5 sm:grid-cols-1 sm:gap-6 lg:grid-cols-1">
            <li v-for="meeting in meetings" :key="meeting.meeting_name" class="col-span-1 flex rounded-md shadow-sm">
                <div class="bg-pink-600 flex w-16 flex-shrink-0 items-center justify-center rounded-l-md text-sm font-medium text-white">{{ meeting.initials }}</div>
                <div class="flex flex-1 items-center justify-between truncate rounded-r-md border-b border-r border-t border-gray-200 bg-white">
                    <div class="flex-1 truncate px-4 py-2 text-sm">
                        <Link :href="route('meetings.show', meeting.id)" class="font-medium text-gray-900 hover:text-gray-600">{{ meeting.meeting_name }}</Link>
                        <p class="text-gray-500">{{ meeting.users_count }} Members from {{ meeting.start_time }} to {{ meeting.end_time }}</p>
                    </div>
                    <div class="flex-shrink-0 pr-2">
                        <Link :href="route('meetings.show', meeting.id)" class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-transparent bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            <span class="sr-only">Open options</span>
                            <EllipsisVerticalIcon class="h-5 w-5" aria-hidden="true" />
                        </Link>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import { EllipsisVerticalIcon } from '@heroicons/vue/20/solid'

defineProps({
    meetings: Array,
})
</script>
