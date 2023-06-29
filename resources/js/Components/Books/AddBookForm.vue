<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

defineProps({
    categories: Array,
})

const showAddForm = ref(false);

const form = useForm({
    'title': '',
    'author': '',
    'year': '',
    'categories_id': [],
});

function toggleCategory(category) {
    if (form.categories_id.includes(category.id)) {
        form.categories_id = form.categories_id.filter(id => id !== category.id);
    } else {
        form.categories_id.push(category.id);
    }
}

function submit() {
    form.post(route('books.store'), {
        onFinish: () => {
            form.title = '';
            form.author = '';
            form.year = '';
            form.categories_id = [];
            showAddForm.value = false;
        },
    });
}

</script>
<template>
    <div v-if="!showAddForm"
        class="p-2 col-span-full bg-slate-500 text-white text-center rounded shadow hover:bg-slate-600 cursor-pointer"
        @click="showAddForm = true">
        Add new book
    </div>
    <div class="p-2 col-span-full border-2 border-slate-500 rounded" v-else>
        <div class="w-full flex justify-end">
            <span class="px-4 text-xs rounded-full bg-red-500 text-white hover:bg-red-600 cursor-pointer"
                @click="showAddForm = false">
                close
            </span>
        </div>
        <form @submit.prevent="submit">
            <TextInput class="w-full border my-1 p-2" v-model="form.title" placeholder="Title" />
            <TextInput class="w-full border my-1 p-2" placeholder="Author" />
            <TextInput name="year" class="w-full border my-1 p-2" type="number" :max="new Date().getFullYear()"
                v-model="form.year" placeholder="Year" />
            <div class="flex gap-2">
                <div v-for="category in categories" :key="category.id"
                    class="border p-2 rounded hover:border-blue-500 cursor-pointer"
                    :class="{ 'bg-green-200': form.categories_id.includes(category.id) }" @click="toggleCategory(category)">
                    {{ category.name }}
                </div>
            </div>
            <PrimaryButton class="w-full border my-1 p-2" type="submit">
                Add
            </PrimaryButton>
        </form>
    </div>
</template>