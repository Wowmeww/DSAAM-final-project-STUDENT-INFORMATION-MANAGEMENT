<script setup>
    import FormInput from '@/Components/FormInput.vue';
    import PageHeading from '@/Components/PageHeading.vue';
    import FormButton from '@/Components/FormButton.vue';
    import DangerButton from '@/Components/DangerButton.vue';
    import { useForm } from '@inertiajs/vue3';


    defineProps({
        courses: Object
    });

    const form = useForm({
        name: null
    });

    const submit = () => {
        form.post(route('subject.store'));
    }


</script>

<template>

    <Head title="Register - Student" />
    <div class="container">
        <PageHeading>Add a Subject</PageHeading>
        <div class="my-6">
            <form @submit.prevent="submit">
                <div class="m-auto lg:w-7/12">
                    <!-- <FormInput name="Email" type="email" :error="form.errors.email" v-model="form.email" /> -->
                    <FormInput :error="form.errors.name" name="Subject Name" v-model="form.name" />

                </div>
                <div class="my-4 md:flex md:justify-center gap-4 gap-x-6 grid ">
                    <div class="inline-grid md:w-3/12">
                        <DangerButton value="Reset" type="reset" />
                    </div>
                    <div class="inline-grid md:w-3/12">
                        <FormButton value="Register" type="submit" :disabled="form.processing" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<style scoped lang="postcss"></style>
