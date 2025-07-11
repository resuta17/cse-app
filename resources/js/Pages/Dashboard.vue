<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';


const props = defineProps({
  categoriesWithCount: Array,
  questions : Object,

})


const OpenQuestion = (catID) => {
  router.visit(route('question', { id: catID}));
};

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
               <div class="p-4 bg-white mt-10 rounded-xl shadow-xl border border-gray-200">
                    <p class="text-center text-xl font-semibold">List of Questions</p>
                    <table class="table-auto border-collapse border border-gray-300 w-full mt-10">
                        <thead>
                            <tr>
                            <th class="border px-2 py-2">No.</th>
                            <th class="border px-4 py-2">Question</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr  v-for="(item, index) in questions.data" :key="item.id">
                                <td @click="OpenQuestion(item.id)"   class="border px-4 py-2 cursor-pointer">{{ index + 1 + questions.from - 1 }}</td>
                                <td @click="OpenQuestion(item.id)" class="border px-4 py-2 cursor-pointer">{{ item.question_text }}</td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <div class="flex gap-2 mt-4">
                        <a
                            v-for="link in questions.links"
                            :key="link.label"
                            :href="link.url"
                            v-html="link.label"
                            :class="[
                            'px-3 py-1 border rounded text-sm',
                            link.active ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 hover:bg-blue-100',
                            !link.url ? 'pointer-events-none text-gray-400' : ''
                            ]"
                        ></a>
                    </div>
               </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
