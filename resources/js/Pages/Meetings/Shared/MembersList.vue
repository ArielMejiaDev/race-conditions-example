<script setup>
import {ref} from "vue";
import {useForm} from "@inertiajs/vue3";

defineProps({
    users: Array
})

const idList = ref([]);

const addUser = function (user) {
    if(idList.value.includes(user.id)) {
        const index = idList.value.indexOf(user.id);
        return idList.value.splice(index, 1);
    }


    idList.value.push(user.id);
}

const form = useForm({
    meeting_name: '',
    start_time: new Date().toISOString().split('T')[0],
    user_ids: [],
});

const submit = () => {
    form.user_ids = idList.value;
    form.post(route('meetings.store'));
};
</script>

<template>
    <fieldset>

        <div v-if="idList.length > 0" class="bg-gray-100 text-gray-600 text-sm p-2 my-4 rounded">
            Selected {{ idList.length }} {{ idList.length > 1 ? 'users' : 'user' }}
        </div>

        <ul v-if="form.errors" class="text-red-600 text-sm p-2 my-4 rounded">
            <li v-for="(error, index) in form.errors" :key="index">{{ error }}</li>
        </ul>

        <form @submit.prevent="submit" class="flex justify-between items-center">
            <legend class="text-base font-semibold leading-6 text-gray-900">Members</legend>
            <div class="flex items-center space-x-8 justify-between">
                <input v-model="form.meeting_name" type="text" name="meeting_name" id="meeting_name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Your Meeting name" />
                <input v-model="form.start_time" type="date" name="start_time" id="start_time" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                <button type="submit" class="rounded-md bg-indigo-600 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Invite
                </button>
            </div>
        </form>
        <div class="mt-4 divide-y divide-gray-200 border-b border-t border-gray-200">
            <div v-for="(user, index) in users" :key="index" class="relative flex items-start py-4">
                <div class="min-w-0 flex-1 text-sm leading-6">
                    <label :for="`user-${user.id}`" class="select-none font-medium text-gray-900">{{ user.name }}</label>
                </div>
                <div class="ml-3 flex h-6 items-center">
                    <input @change="addUser(user)" :id="`person-${user.id}`" :name="`person-${user.id}`" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600" />
                </div>
            </div>
        </div>
    </fieldset>
</template>
