<script setup>
import GuestLayout from "@/layouts/GuestLayout.vue";
import { useForm } from "@inertiajs/vue3";

const form = useForm({
    email: "",
    password: "",
});

const loginUser = () => {
    form.post(route("login.store"), {
        onFinish: () => form.reset("password"),
    });
};
</script>

<template>
    <GuestLayout title="ログイン画面">
        <div class="w-full min-h-screen flex items-center justify-center bg-gradient-to-r from-gray-800 to-gray-600">
            <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-lg">
                <h2 class="text-3xl font-semibold text-center text-gray-800 mb-8">
                    ログイン
                </h2>

                <form @submit.prevent="loginUser" class="space-y-6">
                    <div>
                        <label for="email" class="block text-gray-700 text-sm font-medium">メールアドレス</label>
                        <input type="email" id="email" v-model="form.email" required aria-label="メールアドレス"
                            class="w-full p-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                        <p v-if="form.errors.email" class="text-red-500 text-sm mt-1">{{ form.errors.email }}</p>
                    </div>

                    <div>
                        <label for="password" class="block text-gray-700 text-sm font-medium">パスワード</label>
                        <input type="password" id="password" v-model="form.password" required aria-label="パスワード"
                            class="w-full p-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                        <p v-if="form.errors.password" class="text-red-500 text-sm mt-1">{{ form.errors.password }}</p>
                    </div>

                    <button type="submit" :disabled="form.processing"
                        class="w-full bg-gradient-to-r from-indigo-600 to-indigo-800 text-white font-semibold py-3 px-8 rounded-full shadow-md hover:scale-105 transform transition duration-300">
                        {{ form.processing ? "ログイン中..." : "ログイン" }}
                    </button>
                </form>

                <div class="mt-6 text-center">
                    <p class="text-gray-600 text-sm">
                        アカウントをお持ちでないですか？
                        <a :href="route('register')" class="text-indigo-600 hover:underline">アカウント作成</a>
                    </p>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>

<style scoped>
/* Custom button hover and focus effects */
button:disabled {
    cursor: not-allowed;
}

button:hover {
    transform: scale(1.02);
    transition: transform 0.2s ease;
}

input:focus {
    box-shadow: 0 0 8px rgba(99, 102, 241, 0.5);
}
</style>
