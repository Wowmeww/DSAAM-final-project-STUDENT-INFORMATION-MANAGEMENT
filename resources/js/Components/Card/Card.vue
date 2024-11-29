<script setup>
    import { ref } from 'vue';

    const props = defineProps({
        announcement: Object
    });
    const dateFormatted = (date) => new Date(date).toLocaleDateString("en-us", {
        year: "numeric",
        month: "long",
        day: "numeric",
    });

    const fullContent = props.announcement.content;
    const shortenContent = fullContent.length >= 70 ? fullContent.slice(0, 70) + '...' : fullContent.slice(0, 70);


    const showMore = ref(true);
</script>
<template>
    <div class="card">
        <div class="flex items-center justify-between">
            <span class="card-date">{{ dateFormatted(announcement.created_at) }}</span>
            <div v-if="$page.props.auth.user.access_type == 'admin'" class="space-x-2">
                <Link :href="route('announcement.edit', { announcement })" method="get"
                    class="card-button hover:bg-yellow-400 bg-yellow-400 " tabindex="0">
                    <span class="hidden md:inline pr-1">Edit</span>
                    <i class="bi-pencil"></i>
                </Link>
                <Link :href="route('announcement.destroy', { announcement })" method="delete" as="button" preserveScroll
                    class="card-button bg-red-600 hover:bg-red-500" tabindex="0">
                    <span class="hidden md:inline pr-1">Delete</span>
                    <i class="bi-trash"></i>
                </Link>
            </div>
        </div>

        <div class="mt-2">
            <h3 class="card-title" @click="showMore = !showMore">
                {{ announcement.title }}
            </h3>
            <p class="card-content" v-if="showMore">
                {{ shortenContent }}
            </p>
            <p class="card-content" v-else>
                {{ fullContent }}
            </p>
        </div>

        <div class="flex items-center justify-between mt-4" v-if="fullContent.length >= 70">
            <button class="card-read-more-button" @click="showMore = !showMore">
                <span class="w-full text-wrap block" v-if="showMore">Show more</span>
                <span class="w-full text-wrap block" v-else>Show Less</span>
            </button>
        </div>
    </div>
</template>
<style lang="postcss" scoped>
    .card {
        @apply w-full px-8 py-4 bg-white rounded-lg shadow-md dark:bg-gray-800 text-wrap;
    }

    .card-button {
        @apply rounded px-3 py-1 text-sm font-bold text-gray-100 transition-colors duration-300 transform cursor-pointer;
    }

    .card-date {
        @apply text-sm font-light text-gray-600 dark:text-gray-400;
    }

    .card-title {
        @apply text-xl font-bold text-wrap text-gray-700 dark:text-white hover:text-gray-600 dark:hover:text-gray-200 hover:underline;
    }

    .card-content {
        @apply mt-2 text-gray-600 text-pretty w-full overflow-hidden dark:text-gray-300;
    }

    .card-read-more-button {
        @apply text-blue-600 dark:text-blue-400 hover:underline;
    }

</style>
