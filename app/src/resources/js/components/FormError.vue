<script setup>
const props = defineProps({
    error: { type: String, required: true },
});
</script>

<template>
    <p class="text-red-500 text-sm mt-1">
        {{ error }}
    </p>
</template>
