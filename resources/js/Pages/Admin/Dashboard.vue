<script setup>
    import TextInput from '@/Components/TextInput.vue';
    import { debounce } from 'lodash';
    import { ref, watch } from 'vue';
    import { router } from '@inertiajs/vue3';
    import PageHeading from '@/Components/PageHeading.vue';
    import Card from '@/Components/Card/Card.vue';

    const props = defineProps({
        announcements: Object,
        query: String
    });

    const search = ref(props.query);

    watch(
        search,
        debounce((q) => {
            router.get(route('admin.dashboard'), {
                q: q
            }, {
                preserveState: true
            });
        }, 800)
    );
</script>

<template>
    <Head title="Announcements" />
    <section class="container">
        <PageHeading>Announcements</PageHeading>
        <div class="sm:flex sm:items-center sm:justify-between space-y-2">
            <div class="block md:flex md:items-center md:gap-6">
                <TextInput type="search" v-model="search" class="min-w-96" placeholder="Search" />
            </div>

            <div>
                <Link :href="route('announcement.create')"
                    class="flex items-center justify-center w-full px-5 py-2 text-sm tracking-wide text-white transition-colors duration-200 bg-blue-500 rounded-lg sm:w-auto gap-x-2 hover:bg-blue-600 dark:hover:bg-blue-500 dark:bg-blue-600">
                Add Announcement
                </Link>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-3 md:grid-cols-2 py-10 items-start">
            <Card v-for="announcement in announcements" :keu="announcement.id" :announcement="announcement" />
        </div>

    </section>
</template>
