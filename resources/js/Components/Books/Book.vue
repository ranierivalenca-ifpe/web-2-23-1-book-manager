<script setup>
import EditBookForm from './EditBookForm.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue'
import { ref, computed } from 'vue'
import { useForm } from '@inertiajs/vue3';

const showAllCategories = ref(false)

const props = defineProps({
    'book': Object,
    'categories': Array
})

function remove() {
    if (confirm('Are you sure you want to delete this book?')) {
        useForm({}).delete(Route('books.destroy', props.book.id))
    } ``
}

const unsettedCategories = computed(() => {
    return props.categories.filter(category => {
        return !props.book.categories.find(bookCategory => bookCategory.id === category.id)
    })
})

function removeCategory(category) {
    useForm({}).delete(route('books.remove-category', [props.book.id, category.id]))
}

function addCategory(category) {
    useForm({}).put(route('books.add-category', [props.book.id, category.id]))
}
</script>

<template>
    <div class="border rounded flex flex-col justify-between">
        <div class="p-2" v-if="!showEditForm">
            <h2 class="font-bold text-center mb-2">{{ book.title }}</h2>
            <p>
                {{ book.author }}
                <span class="text-gray-500 text-sm">
                    ({{ book.year }})
                </span>
            </p>
            <div class="border-t p-2 flex flex-wrap justify-center gap-1 mt-2">
                <span v-for="category in book.categories" :key="category.id"
                    class="bg-slate-500 group/cat text-white text-xs rounded p-0.5 pr-1.5 relative overflow-hidden">
                    {{ category.name }}
                    <div class="flex justify-center cursor-pointer transition-all bg-red-600 text-white group-hover/cat:translate-x-0 absolute top-0 bottom-0 right-0 w-4 origin-left translate-x-3"
                        @click="removeCategory(category)">
                        &times;
                    </div>
                </span>
                <span class="bg-slate-700 text-white text-xs rounded p-0.5 px-3 cursor-pointer hover:bg-slate-800"
                    @click="showAllCategories = !showAllCategories">
                    {{ !showAllCategories ? '&plus;' : '&minus;' }}
                </span>
            </div>
            <div class="flex flex-wrap gap-1">
                <span v-for="category in unsettedCategories" :key="category.id"
                    class="bg-slate-500 group/cat relative text-white text-xs rounded p-0.5 pr-1.5 overflow-hidden" v-if="showAllCategories">
                    {{ category.name }}
                    <div class="flex justify-center cursor-pointer transition-all bg-green-600 text-white group-hover/cat:translate-x-0 absolute top-0 bottom-0 right-0 w-4 origin-left translate-x-3"
                        @click="addCategory(category)">
                        &plus;
                    </div>
                </span>
            </div>
        </div>
        <EditBookForm v-if="showEditForm" :book="book" @close="showEditForm = false" />

        <div class="mt-2 border-t-2 p-2 flex justify-around" v-if="!showEditForm">
            <SecondaryButton @click="showEditForm = true">Edit</SecondaryButton>
            <SecondaryButton @click="remove">Delete</SecondaryButton>
        </div>
    </div>
</template>