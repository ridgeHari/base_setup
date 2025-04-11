<script setup>
import { Head } from "@inertiajs/vue3";
const props = defineProps({
  title: { type: String, required: true },
});
</script>

<template>
  <div class="bg-gradient-to-b from-gray-800 to-gray-900 flex flex-col">

    <Head :title="props.title" />

    <main class="flex-grow flex items-center justify-center">
      <slot></slot>
    </main>
  </div>
</template>
