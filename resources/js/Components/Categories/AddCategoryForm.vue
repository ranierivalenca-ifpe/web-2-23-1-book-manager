<script setup>
import { ref } from 'vue';

import TextInput from '@/Components/TextInput.vue';

const showAddForm = ref(false);

const form = useForm({
    'Name': '',
});

function submit() {
    form.post(route('categories.store'), {
        onFinish: () => {
            form.Name = '';
            showAddForm.value = false;
        },
    });
}
</script>

<template>
    <div v-if="!showAddForm"
        class="p-2 col-span-4 bg-slate-500 text-white text-center rounded shadow hover:bg-slate-600 cursor-pointer"
        @click="showAddForm = true">
        Add new category
    </div>
    <div class="p-2 col-span-4 border-2 border-slate-500 rounded" v-else>
        <!-- adding close button -->
        <div class="w-full flex justify-end">
            <span class="px-4 text-xs rounded-full bg-red-500 text-white hover:bg-red-600 cursor-pointer"
                @click="showAddForm = false">
                close
            </span>
        </div>
        <form @submit.prevent="submit">
            <TextInput class="w-full border my-1 p-2" v-model="form.name" placeholder="Title" />
            <PrimaryButton class="w-full border my-1 p-2" type="submit">
                Add
            </PrimaryButton>
        </form>
</div></template>