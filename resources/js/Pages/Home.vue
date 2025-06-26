<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Header from '@/Layouts/Header.vue';
import Footer from '@/Layouts/Footer.vue';
import { router } from '@inertiajs/vue3';

const goToExam = () => {
  router.visit(route('exam'));
};

</script>

<template>
    <Header></Header>
    
    <main class="h-screen px-28 py-8 text-black grid grid-cols-2 mt-5
    bg-[url('https://media.istockphoto.com/id/1401295466/vector/halftone-spotted-background.jpg?s=612x612&w=0&k=20&c=ql7PRJ1ffHk-Zkj4cDeePpLzmqAPzgIVtfBkCsoqK2Q=')] bg-cover bg-center bg-fixed ')">
        
       
    <div class="p-4 rounded">

            <p class="font-black text-black text-2xl mt-5">
                Take our 
                <span class="text-blue-600 font-semibold">free Civil Service Exam</span> 
                practice tests online. 
                <span class="text-red-600 font-semibold">No ads, no paywall</span> — just real questions to help you 
                <span class="text-blue-600 font-semibold">pass with confidence</span>.
            </p>

            <p class="mt-10 mb-2 text-lg font-extrabold  text-black tracking-wid">Test your knowledge now</p>
            <PrimaryButton @click="goToExam">Take the Exam</PrimaryButton>
    </div>
    <div class="p-4 rounded">
            
    </div>
    </main>
    
    <Footer></Footer>
    
</template>
