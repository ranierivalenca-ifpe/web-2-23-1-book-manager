<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Category from '@/Components/Categories/Category.vue';
import AddCategoryForm from '@/Components/Categories/AddCategoryForm.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    categories: Array,
});

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
            <Category v-for="category in Categories" :key="category.id" :category="category" />

            <AddCategoryForm />
        </div>
    </AuthenticatedLayout>
</template>