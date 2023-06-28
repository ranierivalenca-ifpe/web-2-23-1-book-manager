<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const showAddForm = ref(false);

const form = useForm({
    'name': '',
});

const props = defineProps({
    categories: Array,
});

function submit() {
    form.post(route('categories.store'), {
        onFinish: () => {
            form.name = '';
            showAddForm.value = false;
        },
    });
}

function remove(category) {
    if (confirm('Are you sure you want to delete this category?')) {
        form.delete(route('categories.destroy', category.id));
    }
}

function edit(category) {
    const newName = prompt('Enter new category name', category.name);
    if (!newName) return;
    
    const updateForm = useForm({
        'name': newName
    })

    updateForm.put(route('categories.update', category.id), {
    });
}
</script>

<template>
    <Head title="Books" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Categories
            </h2>
        </template>
        
        <div class="grid grid-cols-4 gap-4">
            <div v-for="category in categories" :key="category.id" class="p-4 border text-center rounded relative category">
                {{ category.name }}
                <div class="absolute top-0 bottom-0 left-0 right-0 grid grid-cols-2 rounded options">
                    <div class="p-4 h-full bg-green-600 text-white hover:bg-green-700 hover:scale-110 bg-opacity-90 cursor-pointer" @click="edit(category)">
                        Edit
                    </div>
                    <div class="p-4 h-full bg-red-500 text-white hover:bg-red-600 bg-opacity-90 hover:scale-110 cursor-pointer" @click="remove(category)">
                        Delete
                    </div>
                </div>
            </div>
            <div v-if="!showAddForm" class="p-2 col-span-4 bg-slate-500 text-white text-center rounded shadow hover:bg-slate-600 cursor-pointer" @click="showAddForm = true">
                Add new category
            </div>
            <div class="p-2 col-span-4 border-2 border-slate-500 rounded" v-else>
                <!-- adding close button -->
                <div class="w-full flex justify-end">
                    <span class="px-4 text-xs rounded-full bg-red-500 text-white hover:bg-red-600 cursor-pointer" @click="showAddForm = false">
                        close
                    </span>
                </div>
                <form @submit.prevent="submit">
                    <TextInput class="w-full border my-1 p-2" v-model="form.name" placeholder="Title" />
                    <PrimaryButton class="w-full border my-1 p-2" type="submit">
                        Add
                    </PrimaryButton>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
.category {
    transition: all 0.3s ease-in-out;
}


.options {
    opacity: 0;
    transition: all 0.3s ease-in-out;
}

.category:hover .options {
    opacity: 1;
}
</style>