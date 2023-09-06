<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import MeetMembers from "@/Pages/Meetings/Shared/MeetMembers.vue";

defineProps({
    meet: Object,
})

</script>

<template>
    <Head title="Meet" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Meet</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                    <MeetMembers :members="meet.users" />

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
