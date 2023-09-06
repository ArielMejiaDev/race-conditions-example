<script setup>
import { Head } from '@inertiajs/vue3';
import MembersList from "@/Pages/Meetings/Shared/MembersList.vue";
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

defineProps({
    users: Array
})
</script>

<template>
    <Head title="New Meet" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">New Meet</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">

                        <MembersList :users="users" />

                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
