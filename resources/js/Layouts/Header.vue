<script setup>
import NavLink from '@/Components/NavLink.vue';
</script>

<template>
    <header class="sticky top-0 z-50 bg-white shadow">
        <div class="grid grid-flow-col auto-cols-fr">
            <div class="bg-blue-900 h-2"></div>
            <div class="bg-red-600 h-2"></div>
            <div class="bg-blue-900 h-2"></div>
        </div>
        <nav class="shadow-lg h-20 rounded-b-lg flex items-center justify-between px-28 bg-white">
             <div class="flex items-center gap-4">
                <img 
                    :src="'https://cdn-icons-png.flaticon.com/128/13972/13972644.png'" 
                    alt="Logo" 
                    class="w-10 h-10"
                />
                <h1 class="font-bold text-2xl text-gray-800">
                    CSE Reviewer Hub
                </h1>
            </div>

            <div class="flex gap-6">
                <NavLink :href="route('home')" :active="$page.url === '/'">Home</NavLink>
                <NavLink :href="route('about')" :active="$page.url === '/about'">About</NavLink>
                <NavLink>Contribute</NavLink>
                <NavLink>Donate</NavLink>
            </div>
        </nav>
    </header>
</template>