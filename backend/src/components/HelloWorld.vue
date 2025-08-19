<script setup>
import { computed } from 'vue';
import store from '../store';

const test = computed(() => store.state.test)

</script>

<template>
  <div class="text-gray-800 text-7xl flex justify-center mt-10">
    {{ test }}
  </div>
</template>

<style scoped>

</style>
