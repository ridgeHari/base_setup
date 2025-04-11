<script setup>
import { defineProps } from "vue";
import Button from "@/components/Button.vue";
import { Link } from "@inertiajs/vue3";
const appName = window.appName;

const props = defineProps({
    auth: { type: Object, required: true },
    navigation: { type: Array, required: true },
    logout: { type: Function, required: true },
});
</script>

<template>
    <aside v-if="props.auth" class="w-64 bg-white h-full p-6 flex flex-col shadow-md border-r">
        <span class="text-4xl text-center font-bold text-gray-800 mb-6 inline-block cursor-pointer">
            {{appName}}
        </span>

        <nav class="flex-1">
            <ul>
                <li v-for="item in props.navigation" :key="item.route" class="mb-2">
                    <Link :href="route(item.route)" class="flex items-center px-4 py-2 rounded-md transition space-x-2"
                        :class="{
                            'bg-gray-100 text-gray-900 font-semibold shadow-sm':
                                route().current(item.route),
                            'hover:bg-gray-100 hover:text-gray-700':
                                !route().current(item.route),
                        }">
                    <i :class="['fa', item.icon, 'w-5 h-5 text-gray-600']"></i>
                    <span>{{ item.name }}</span>
                    </Link>
                </li>
            </ul>
        </nav>
        <Button :text="'ログアウト'" :onClick="props.logout"
            class="mt-auto bg-red-500 text-white px-5 py-2 rounded-md hover:bg-red-600 shadow-md" />
    </aside>
</template>
