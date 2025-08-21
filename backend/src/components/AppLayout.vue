<script setup>
import {onMounted, onUnmounted, ref} from 'vue'
import Sidebar from "./Sidebar.vue";
import TopHeader from "./TopHeader.vue";
import store from '../store';

defineProps({
    title: String
})

onMounted(() => {
    store.dispatch('getUser')
    updateSidebarState()
    window.addEventListener('resize', updateSidebarState)
})

onUnmounted(() => {
    window.removeEventListener('resize', updateSidebarState)
})

const sidebarOpened = ref(true);

function toggleSidebar() {
    sidebarOpened.value = !sidebarOpened.value
}
function updateSidebarState() {
    sidebarOpened.value = window.innerWidth > 768
}

</script>

<template>
    <div class="min-h-full flex">
        <!--    Sidebar-->
        <Sidebar :class="{'-ml-[200px]': !sidebarOpened}"/>
        <!--/    Sidebar-->
        
        <div class="flex-1">
            <TopHeader @toggle-sidebar="toggleSidebar"></TopHeader>
            <!--      Content-->
            <main class="p-6">
                <router-view></router-view>
            </main>
            <!--      Content-->
        </div>
    </div>
</template>