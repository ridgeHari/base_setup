<script setup>
import Sidebar from "@/components/Sidebar.vue";
import { Head, useForm } from "@inertiajs/vue3";

const props = defineProps({
    auth: { type: Object, required: true },
    title: { type: String, required: true },
});

const form = useForm({});

const logout = () => {
    form.post(route("logout"));
};

const navigation = [
    { name: "Home", route: "home", icon: "fa-home" },
];
</script>

<template>
    <div class="h-screen flex overflow-hidden">
        <Head :title="props.title"></Head>

        <Sidebar :auth="props.auth" :navigation="navigation" :logout="logout" />

        <div class="flex-1 flex flex-col min-h-0">
            <main class="flex-1 overflow-y-auto p-6 bg-white">
                <div class="w-full bg-white p-6 rounded-lg">
                    <slot></slot>
                </div>
            </main>
        </div>
    </div>
</template>
