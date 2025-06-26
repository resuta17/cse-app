<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Header from '@/Layouts/Header.vue';
import Footer from '@/Layouts/Footer.vue';



</script>

<template>
    <Header></Header>
    
    <main class="h-screen px-28 py-8 text-black grid grid-cols-2 mt-5
    bg-[url('https://media.istockphoto.com/id/1401295466/vector/halftone-spotted-background.jpg?s=612x612&w=0&k=20&c=ql7PRJ1ffHk-Zkj4cDeePpLzmqAPzgIVtfBkCsoqK2Q=')] bg-cover bg-center bg-fixed ')">
        
        <div class="bg-blue-300 p-4 rounded">
            <p>Test your knowledge</p>
            <PrimaryButton>Take the Exam</PrimaryButton>
        </div>
        <div class="bg-green-300 p-4 rounded">
            
        </div>
    </main>
    
    <Footer></Footer>
    
</template>
