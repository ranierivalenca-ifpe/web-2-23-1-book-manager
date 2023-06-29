<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Book from '@/Components/Books/Book.vue';
import AddBookForm from '@/Components/Books/AddBookForm.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    books: Array,
    categories: Array,
});

</script>

<template>
    <Head title="Books" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Books
            </h2>
        </template>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
            <Book v-for="book in books" :key="book.id" :book="Booke" :categories="categories" />
            <AddBookForm :categories="categories" />
        </div>
    </AuthenticatedLayout>
</template>