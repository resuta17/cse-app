<script setup>
import Header from '@/Layouts/Header.vue';

defineProps({
  categories: Array
})
</script>

<template>
    <Header></Header>
    {{ categories }}
</template>