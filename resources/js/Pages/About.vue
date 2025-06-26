<script setup>
import Header from '@/Layouts/Header.vue';

defineProps({
  questions: Array
})
</script>

<template>
    <Header></Header>
    {{ questions }}
    <p class="text-black">about</p>
</template>