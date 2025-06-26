<script setup>
import Header from '@/Layouts/Header.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import Footer from '@/Layouts/Footer.vue';
</script>

<template>
    <Header></Header>
    <div class="min-h-screen">
        <div class="flex items-center mt-20 justify-center space-x-2">
            <SecondaryButton>Numerical</SecondaryButton>
            <SecondaryButton>Verbal</SecondaryButton>
            <SecondaryButton>Analytical</SecondaryButton>
            <SecondaryButton>Clerical</SecondaryButton>
            <SecondaryButton>General Information</SecondaryButton>
        </div>
        <div class="flex items-center mt-5 justify-center space-x-2">
            <SecondaryButton>Prof</SecondaryButton>
            <SecondaryButton>Sub</SecondaryButton>
        </div>
    </div>
    
    
    <Footer></Footer>
    
</template>