<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';


const props = defineProps({
  categoriesWithCount: Array,

})

</script>



<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
               <p class="text-lg mb-4 ">Number of Questions per Category.</p>
               <div class="grid grid-cols-5 space-x-4">
                    <div v-for="category in categoriesWithCount" class="bg-gray-200 h-32 w-54 shadow-xl rounded-lg border border-gray-100 flex justify-center p-4 grid bg-blue-800 text-white">
                        <p class="text-xl font-bold"> {{ category.name }} </p>
                        <p class="text-center text-2xl font-black"> {{category.questions_count}} </p>
                    </div>
               </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
