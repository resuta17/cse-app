<script setup>
import Header from '@/Layouts/Header.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import Footer from '@/Layouts/Footer.vue';
import { router } from '@inertiajs/vue3';
import { Head } from '@inertiajs/vue3';

defineProps({
  categories: Array
})


const TakeExamination = (cat, catID) => {
  router.visit(route('practice', { name: cat ,id: catID}));
};

</script>

<template>
    <Head title="Exam" />
    <Header></Header>
    <div class="min-h-screen">
        <div><p>Select a category to boost your confidence and exam readiness.</p></div>
        <div  class="flex items-center mt-20 justify-center space-x-2">
            <SecondaryButton v-for="category in categories" @click="TakeExamination( category.name ,category.id)">{{ category.name }}</SecondaryButton>
        </div>
        <div class="flex items-center mt-5 justify-center space-x-2">
            <SecondaryButton>Prof</SecondaryButton>
            <SecondaryButton>Sub</SecondaryButton>
        </div>
        <div class="flex items-center mt-10 justify-center">
            <!-- <button class="shadow-lg border border-gray-500 px-4 py-2 bg-green-600 text-white rounded-md">Start</button> -->
        </div> 
    </div>
    
    <Footer></Footer>
    
</template>