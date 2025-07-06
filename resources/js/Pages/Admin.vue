<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>


<template>
    <Head title="Admin" />
    <AuthenticatedLayout>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="p-8 bg-white border border-gray-100 shadow-md">
                    <p class="text-center text-xl font-bold mb-4"> Add Question </p>
                    <p>Question</p>
                    <textarea name="question" id="question" class="w-full border p-2 border-gray-300 rounded-md	">
                        
                    </textarea>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>