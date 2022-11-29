<script setup>
import {Head, useForm} from '@inertiajs/inertia-vue3'

import BreezeButton from '@/Components/PrimaryButton.vue'
import Layout from "@/Layouts/Layout.vue";

const props = defineProps({
    todo: {
        type: Object,
        default: () => ({})
    }
})

const form = useForm({
    content: props.todo.content
})

function submit() {
    form.put(route('todos.update', props.todo.id))
}

</script>

<template>
    <Head title="Todos"/>

    <Layout>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form @submit.prevent="submit">
                            <div class="mb-6">
                                <label for="content" class="block mb-2 text-sm font-medium text-gray-900">
                                    Content
                                </label>
                                <input
                                    type="text"
                                    v-model="form.content"
                                    name="content"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder=""
                                />
                                <div
                                    v-if="form.errors.content"
                                    class="text-sm text-red-600"
                                >
                                    {{ form.errors.content }}
                                </div>
                            </div>

                            <BreezeButton
                                class="text-white bg-blue-700 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5"
                                :disabled="form.processing"
                                :class="{ 'opacity-25': form.processing }"
                            >
                                Submit
                            </BreezeButton>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>
