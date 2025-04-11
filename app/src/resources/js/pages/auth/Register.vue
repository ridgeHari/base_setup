<script setup>
import GuestLayout from "@/layouts/GuestLayout.vue";
import { useForm } from "@inertiajs/vue3";

const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
});

const registerUser = () => {
    form.post(route("register.store"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};
</script>

<template>
    <GuestLayout title="ユーザー登録画面">
        <div class="w-full min-h-screen flex items-center justify-center bg-gradient-to-r from-gray-800 to-gray-600">
            <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md">
                <h2 class="text-3xl font-semibold text-center text-gray-800 mb-6">
                    ユーザー登録
                </h2>

                <form @submit.prevent="registerUser" class="space-y-6">
                    <div>
                        <label for="name" class="block text-gray-700 text-sm font-medium">名前</label>
                        <input type="text" id="name" v-model="form.name" required
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" />
                        <p v-if="form.errors.name" class="text-red-500 text-sm mt-1">{{ form.errors.name }}</p>
                    </div>

                    <div>
                        <label for="email" class="block text-gray-700 text-sm font-medium">メールアドレス</label>
                        <input type="email" id="email" v-model="form.email" required
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" />
                        <p v-if="form.errors.email" class="text-red-500 text-sm mt-1">{{ form.errors.email }}</p>
                    </div>

                    <div>
                        <label for="password" class="block text-gray-700 text-sm font-medium">パスワード</label>
                        <input type="password" id="password" v-model="form.password" required
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" />
                        <p v-if="form.errors.password" class="text-red-500 text-sm mt-1">{{ form.errors.password }}</p>
                    </div>

                    <div>
                        <label for="password_confirmation"
                            class="block text-gray-700 text-sm font-medium">パスワード確認</label>
                        <input type="password" id="password_confirmation" v-model="form.password_confirmation" required
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" />
                    </div>

                    <button type="submit" :disabled="form.processing"
                        class="w-full bg-gradient-to-r from-indigo-600 to-indigo-800 text-white font-semibold py-3 px-8 rounded-full shadow-md hover:scale-105 transform transition duration-300">
                        {{ form.processing ? "登録中..." : "登録" }}
                    </button>
                </form>

                <div class="mt-6 text-center">
                    <p class="text-gray-600 text-sm">
                        既にアカウントをお持ちですか？
                        <a :href="route('login')" class="text-green-600 hover:underline">ログイン</a>
                    </p>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>

<style scoped>
/* Custom focus and button styles */
button:disabled {
    cursor: not-allowed;
}

/* Custom focus effect for inputs */
input:focus {
    box-shadow: 0 0 8px rgba(72, 201, 85, 0.5);
    /* Greenish focus shadow */
}
</style>
