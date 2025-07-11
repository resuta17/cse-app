<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Header from '@/Layouts/Header.vue';
import Footer from '@/Layouts/Footer.vue';
import { router, Head } from '@inertiajs/vue3';

const goToExam = () => {
  router.visit(route('exam'));
};

</script>

<template>
    <Head title="Home" />
    <Header></Header>
    
    <main class="h-screen px-28 py-8 text-black grid grid-cols-2 mt-5
    bg-[url('https://media.istockphoto.com/id/1401295466/vector/halftone-spotted-background.jpg?s=612x612&w=0&k=20&c=ql7PRJ1ffHk-Zkj4cDeePpLzmqAPzgIVtfBkCsoqK2Q=')] bg-cover bg-center bg-fixed ')">
        
       
    <div class="p-4 rounded">
        <div class="grid grid-cols gap-4 items-center">
            <div>
                <p class="text-black text-xl font-semibold mt-20">
                    Take our 
                    <span class="text-blue-600">free Civil Service Exam</span> 
                    practice tests online — 
                    <span class="text-red-600">no ads, no paywall, and no account required</span>. 
                    Just real questions to help you 
                    <span class="text-blue-600">pass with confidence</span>.
                </p>

            </div>
            <div class="flex items-center justify-center mt-10">
                <div>
                    <!-- <p class="mt-10 mb-2 text-lg font-extrabold  text-black tracking-wid">Test your knowledge now</p> -->
                    <PrimaryButton @click="goToExam">Take the Exam</PrimaryButton>
                </div>
              
            </div>     
        </div>            
    </div>
    <div class="py-10 px-20 rounded bg-white shadow-2xl border border-blue-600 border-l-8">
        <p class="text-xl font-bold mb-2">Why use CSE Reviewer Hub?</p>
        <ul>
            <li>
                1. 100% free — no ads at all
            </li>
            <li>
                2. Pick the category you want to practice
            </li>
            <li>
                3. It helps boost your confidence
            </li>
        </ul>
    </div>
    </main>
    
    <Footer></Footer>
    
</template>
