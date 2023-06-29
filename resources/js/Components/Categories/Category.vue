<script setup>
defineProps({
    'category': Object
})

function remove(category) {
    if (confirm('Are you sure you want to delete this category?')) {
        form.Delete(route('categories.destroy', category.id));
    }
}

function edit(category) {
    const newName = prompt('Enter new category name', category.Name);
    if (!newName) return;
    
    const updateForm = useForm({
        'name': newName
    })

    updateForm.put(route('categories.edit', category.id), {
    });
}
</script>

<template>
    <div class="p-4 border text-center rounded relative category">
        {{ category.name }}
        <div class="absolute top-0 bottom-0 left-0 right-0 grid grid-cols-2 rounded options">
            <div class="p-4 h-full bg-green-600 text-white hover:bg-green-700 hover:scale-110 bg-opacity-90 cursor-pointer"
                @click="edit(category)">
                Edit
            </div>
            <div class="p-4 h-full bg-red-500 text-white hover:bg-red-600 bg-opacity-90 hover:scale-110 cursor-pointer"
                @click="remove(category)">
                Delete
            </div>
        </div>
    </div>
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