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
    <div class="min-h-screen flex justify-center items-center">
        <div class="border p-10 w-full max-w-4xl text-center bg-blue-200 border-black rounded-lg">
            <div>
                <p class="text-lg font-medium">Select a category to boost your confidence and exam readiness.</p>
            </div>

            <div class="flex flex-wrap justify-center items-center mt-10 gap-2">
                <SecondaryButton
                    v-for="category in categories"
                    :key="category.id"
                    @click="TakeExamination(category.name, category.id)"
                >
                    {{ category.name }}
                </SecondaryButton>
            </div>
             <div>
                <p class="text-lg font-medium mt-5">Select a mock up.</p>
            </div>

            <div class="flex justify-center items-center mt-5 gap-2">
                <SecondaryButton>Prof</SecondaryButton>
                <SecondaryButton>Sub</SecondaryButton>
            </div>
        </div>
    </div>

    
    <Footer></Footer>
    
</template>