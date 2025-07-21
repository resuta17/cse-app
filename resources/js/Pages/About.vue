<script setup>
import Header from '@/Layouts/Header.vue';
import Footer from '@/Layouts/Footer.vue';
</script>

<template>
        <Header />
        <div class="m-20 h-screen">
            <h2 class="text-2xl font-bold mb-4 mt-4">What is CSE?</h2>
            <p class="mb-4">
                <strong>CSE</strong> stands for <strong>Civil Service Examination</strong>. It is a nationwide exam conducted by the 
                <strong>Civil Service Commission (CSC)</strong> in the Philippines to determine whether an individual is 
                eligible to work in government positions. Passing the CSE is one of the main requirements to become a 
                <strong>civil servant</strong> in the country.
            </p>
            <p class="mb-4">
                There are two levels of the exam:
            </p>
            <ul class="list-disc list-inside mb-4">
                <li><strong>Professional Level</strong> – for those seeking higher positions in government.</li>
                <li><strong>Subprofessional Level</strong> – for clerical or support roles.</li>
            </ul>
            <p class="mb-2">
                The exam covers the following areas:
            </p>
            <ul class="list-disc list-inside">
                <li><strong>Verbal Ability</strong> – Grammar, Vocabulary, Reading Comprehension</li>
                <li><strong>Numerical Ability</strong> – Basic Math, Word Problems</li>
                <li><strong>Analytical Ability</strong> – Logic, Pattern Recognition</li>
                <li><strong>General Information</strong> – Philippine Constitution, current events, government code</li>
            </ul>           
        </div>
        <Footer />

</template>