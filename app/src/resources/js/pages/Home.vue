<script setup>
import AppLayout from "@/layouts/AppLayout.vue";

const props = defineProps({
  auth: { type: Object },
});
</script>

<template>
  <AppLayout title="ホーム画面" :auth="auth">
    <div class="bg-gray-50 h-screen pd-6 flex items-center justify-center pb-64">
      <div class="text-center max-w-md w-full p-8 bg-white shadow-lg rounded-lg">
        <h2 class="text-3xl font-semibold text-gray-800 mb-6">ダッシュボードへようこそ</h2>
        <p class="text-gray-600 mb-8">詳細なインサイトのためにレポートセクションにアクセスしてください。</p>
      </div>
    </div>
  </AppLayout>
</template>

<style scoped>
/* Custom button hover and focus effects */
a:hover {
  transform: scale(1.05);
  transition: transform 0.2s ease;
}

a:focus {
  outline: none;
  box-shadow: 0 0 8px rgba(38, 198, 218, 0.5);
}
</style>
