<script setup>
    import FormInput from '@/Components/FormInput.vue';
    import PageHeading from '@/Components/PageHeading.vue';
    import FormButton from '@/Components/FormButton.vue';
    import DangerButton from '@/Components/DangerButton.vue';
    import { useForm } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';

    defineProps({
        courses: Object
    });

    const form = useForm({
        title: null,
        content: null
    });

    const submit = () => {
        form.post(route('announcement.store'));
    }


</script>

<template>

    <Head title="Register - Student" />
    <div class="container">
        <PageHeading>Add an Announcement</PageHeading>
        <div class="my-6">
            <form @submit.prevent="submit">
                <div class="m-auto lg:w-7/12">
                    <!-- <FormInput name="Email" type="email" :error="form.errors.email" v-model="form.email" /> -->
                    <FormInput :error="form.errors.title" name="Title" v-model="form.title" />
                    <InputLabel value="Content" />
                    <textarea v-model="form.content" rows="10" id="Content" class="block w-full bg-transparent outline-none rounded-md mt-2" placeholder="Content"></textarea>

                </div>
                <div class="my-4 md:flex md:justify-center gap-4 gap-x-6 grid ">
                    <div class="inline-grid md:w-3/12">
                        <DangerButton value="Reset" type="reset" />
                    </div>
                    <div class="inline-grid md:w-3/12">
                        <FormButton value="Post" type="submit" :disabled="form.processing" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<style scoped lang="postcss"></style>
