<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import MyTextInput from '@/Components/MyTextInput.vue';
import { useForm } from '@inertiajs/vue3';

const emit = defineEmits(['close']);

const props = defineProps({
    book: Object
})

const form = useForm({
    'title': props.book.title,
    'author': props.book.author,
    'year': props.book.year,
});

function close() {
    emit('close');
}

function submit() {
    form.put(route('books.update', props.book.id), {
        onFinish: () => close(),
    });
}
</script>

<template>
    <form class="p-2" @submit.prevent="submit">
        <!-- <div class="border">
            <span class="text-xs ml-2 text-gray-700">Title</span>
            <input type="text" v-model="form.title" class="border-0 focus:border-0 focus:ring-0 pl-2 pt-0">
        </div> -->
        <!-- <TextInput class="w-full border my-1 p-2" v-model="form.title" placeholder="Title" /> -->
        <MyTextInput title="Title" class="w-full my-1" v-model="form.title" />
        <MyTextInput title="Author" class="w-full my-1" v-model="form.author" />

        <TextInput name="year" class="w-full border my-1 p-2" type="number" :max="new Date().getFullYear()"
            v-model="form.year" placeholder="Year" />
        <div class="flex justify-around mt-2">
            <PrimaryButton>Save</PrimaryButton>
            <SecondaryButton @click.prevent="close">Cancel</SecondaryButton>
        </div>
    </form>
</template>