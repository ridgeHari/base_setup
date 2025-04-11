<script setup>
import { defineProps } from "vue";

const props = defineProps({
    text: { type: String, required: false },
    onClick: { type: Function, required: true },
    type: { type: String, default: "submit" },
    class: {
        type: String,
        default:
            "bg-gray-900 text-white py-2 px-4 rounded hover:bg-gray-600 transition disabled:opacity-50",
    },
    isDisabled: { type: Boolean, default: false },
    loadingText: { type: String, default: "処理中..." },
    icon: { type: String, default: "" },
    iconLocation: { type: String, default: "front" },
});
</script>

<template>
    <button
        :type="props.type"
        :class="props.class"
        :disabled="props.isDisabled"
        @click="props.onClick"
    >
        <i
            v-if="props.iconLocation === 'front' && props.icon"
            :class="props.icon"
            class="mr-2"
        ></i>
        {{ props.isDisabled ? props.loadingText : props.text }}
        <i
            v-if="props.iconLocation === 'back' && props.icon"
            :class="props.icon"
            class="mr-2"
        ></i>
    </button>
</template>
