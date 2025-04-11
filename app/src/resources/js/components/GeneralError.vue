<script setup>
const props = defineProps({
    error: { type: String, required: true },
});
</script>

<template>
    <p v-if="error" class="text-red-500 text-sm mb-2">
        {{ error }}
    </p>
</template>
