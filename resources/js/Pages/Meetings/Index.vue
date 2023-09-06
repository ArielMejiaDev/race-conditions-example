<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import Meetings from "@/Pages/Meetings/Shared/Meetings.vue";

defineProps({
    meetings: Array,
})

</script>

<template>
    <Head title="Meetings" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Meetings</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                    <div class="flex items-center justify-end">
                        <Link :href="route('meetings.create')" type="button" class="rounded-md bg-indigo-600 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            New Meet
                        </Link>
                    </div>
                    <div>
                        <Meetings class="m-2" :meetings="meetings" />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
