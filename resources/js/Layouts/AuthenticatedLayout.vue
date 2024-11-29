<script setup>
    import Alert from '@/Components/Alert.vue';
    import LogoutModal from '@/Components/LogoutModal.vue';
    import ResponsiveNav from '@/Components/ResponsiveNav.vue';
    import { ref } from 'vue';

    const logoutModalOpen = ref(false);
</script>

<template>
    <div>
        <div class="min-h-screen flex flex-col bg-gray-100 dark:bg-gray-900 relative">
            <header>
                <ResponsiveNav @logout="logoutModalOpen = true" />
            </header>
            <!-- Page Content -->
            <main class="flex-1">
                <Alert :message="$page.props.flash.message" @close="$page.props.flash.message = null" />
                <!-- <Alert :message="$page.props.flash.message" v-if="$page.props.flash.message" /> -->
                <LogoutModal :isOpen="logoutModalOpen" v-on:cancel="logoutModalOpen = false" />
                <slot />
            </main>
        </div>
    </div>
</template>

<style scoped lang="postcss">
    a {
        @apply text-sm font-medium;
    }
</style>
