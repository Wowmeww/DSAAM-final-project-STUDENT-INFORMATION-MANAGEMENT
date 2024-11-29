<script setup>

    import DangerButton from '@/Components/DangerButton.vue';
    import FormButton from '@/Components/FormButton.vue';
    import PageHeading from '@/Components/PageHeading.vue';
    import { useForm } from '@inertiajs/vue3';


    const props = defineProps({
        announcement: Object
    });

    const form = useForm({
        title: props.announcement.title,
        content: props.announcement.content
    });

    const submit = () => {
        form.patch(route('announcement.update', { announcement: props.announcement }));
    }
</script>

<template>

    <Head title="Edit Announcement" />
    <section class="container">
        <PageHeading>Edit Announcement</PageHeading>
        <form @submit.prevent="submit"
            class="max-w-4xl m-auto px-8 py-4 bg-white rounded-lg shadow-md dark:bg-gray-800 text-wrap">
            <div>
                <input type="text" class="card-input card-title" v-model="form.title" />
            </div>
            <div>
                <textarea rows="6" class="card-input" v-model="form.content"> </textarea>
            </div>
            <div class="flex justify-center md:justify-end mt-4 space-x-3">
                <Link :href="route('admin.dashboard')"
                    class="px-4 py-2 border rounded-lg border-gray-50/65 font-semibold hover:bg-gray-100/25">Back</Link>
                <FormButton value="Update" type="submit" />
            </div>
        </form>
    </section>
</template>

<style scoped lang="postcss">
    .card-input {
        @apply bg-transparent border-none ring-transparent block w-full p-0 hover:ring-transparent active:border-none text-gray-600 text-pretty overflow-hidden dark:text-gray-300;
    }

    .card-title {
        @apply text-xl font-bold text-wrap text-gray-700 dark:text-white hover:text-gray-600 dark:hover:text-gray-200;
    }
</style>
