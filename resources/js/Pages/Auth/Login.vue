<script setup>
    import FormButton from '@/Components/FormButton.vue';
    import FormInput from '@/Components/FormInput.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import PageHeading from '@/Components/PageHeading.vue';
    import GuestLayout from '@/Layouts/GuestLayout.vue';
    import { useForm } from '@inertiajs/vue3';
    defineOptions({
        layout: GuestLayout
    });

    const form = useForm({
        email: null,
        password: null,
        remember: false
    });

    const submit = () => {
        form.post(route('login'), {
            onError: ()=> form.reset('password')
        });
    }


</script>

<template>

    <Head title="Log in" />
    <div class="h-full flex justify-center items-start sm:items-center ">
        <section
            class="w-full md:w-6/12 max-w-lg p-6 mx-auto bg-white rounded-md shadow-md dark:bg-gray-800 h-fit mt-24 sm:mt-0">
            <PageHeading>Log in</PageHeading>
            <form @submit.prevent="submit">

                <FormInput name="Email" type="email" :error="form.errors.email" v-model="form.email" />

                <FormInput name="Password" type="password" :error="form.errors.password" v-model="form.password" />

                <div class="mt-2" >
                    <span class="flex justify-start items-center gap-x-2" >
                        <input type="checkbox" id="Remember me" class="rounded" v-model="form.remember" />
                        <InputLabel value="Remember me" />
                    </span>
                    <span>

                    </span>
                </div>
                <div class="flex justify-center my-4">
                    <FormButton :disabled="form.processing" class="w-full sm:w-4/12 max-w-md min-w-fit">
                        Log in
                    </FormButton>
                </div>
                <div class="border border-slate-500 dark:border-white/20"></div>
            </form>
        </section>
    </div>
</template>
