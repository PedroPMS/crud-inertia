<script setup>
import {Head, Link, useForm} from '@inertiajs/inertia-vue3'
import {Inertia} from "@inertiajs/inertia";
import {useToast} from "vue-toastification";
import {watch, onMounted} from 'vue'

import Button from '@/Components/PrimaryButton.vue'
import Layout from "@/Layouts/Layout.vue";

const props = defineProps({
    todos: {
        type: Object,
        default: () => ({})
    }
})

function destroy(id) {
    const form = useForm();
    if (confirm('Are you realy sure you want to DELETE')) {
        form.delete(route('todos.destroy', id))
    }
}

function done(todo) {
    const form = useForm({is_done: !todo.is_done});
    form.put(route('todos.update', todo.id))
}

function showToast() {
    const message = Inertia.page.props.flash.message;
    if (!message) {
        return;
    }

    const toast = useToast();
    toast.success(message);
}

onMounted(() => {
    showToast();
});

watch(() => props.todos, () => {
    showToast();
});

</script>

<template>
    <Head title="Todos"/>

    <Layout>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="mb-2">
                            <Link :href="route('todos.create')">
                                <Button>
                                    Add Todo
                                </Button>
                            </Link>
                        </div>

                        <div class="relative overflow-y-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left text-gray-500">
                                <thead class="text-xs text-gray-700 bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-4">#</th>
                                    <th scope="col" class="px-6 py-4">Content</th>
                                    <th scope="col" class="px-6 py-4">Done</th>
                                    <th scope="col" class="px-6 py-4">Edit</th>
                                    <th scope="col" class="px-6 py-4">Delete</th>
                                </tr>
                                </thead>

                                <tbody>
                                <tr
                                    v-for="todo in todos"
                                    :key="todo.id"
                                    class="bg-white border-b"
                                >
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900">
                                        {{ todo.id }}
                                    </th>
                                    <th scope="row" :class="{'line-through': todo.is_done}"
                                        class="px-6 py-4 font-medium text-gray-900">
                                        {{ todo.content }}
                                    </th>

                                    <td class="px-6 py-4">
                                        <input class="focus:ring-0" type="checkbox" id="checkbox" @click="done(todo)"
                                               v-model="todo.is_done">
                                    </td>

                                    <td class="px-6 py-4">
                                        <Link
                                            :href="route('todos.edit', todo.id)"
                                            class="px-4 py-2 text-white bg-blue-600 rounded-lg"
                                        >
                                            Edit
                                        </Link>
                                    </td>
                                    <td class="px-6 py-4">
                                        <Button
                                            class="bg-red-700"
                                            @click="destroy(todo.id)"
                                        >
                                            Delete
                                        </Button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>

<style>
#app {
    font-family: Avenir, Helvetica, Arial, sans-serif;
    text-align: center;
    color: #2c3e50;
}
</style>
