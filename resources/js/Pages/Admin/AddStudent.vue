<script setup>
    import FormInput from '@/Components/FormInput.vue';
    import InputSelect from '@/Components/InputSelect.vue';
    import PageHeading from '@/Components/PageHeading.vue';
    import FormButton from '@/Components/FormButton.vue';
    import DangerButton from '@/Components/DangerButton.vue';
    import { useForm } from '@inertiajs/vue3';
    import { ref, watch } from 'vue';

    defineProps({
        courses: Object
    });

    const form = useForm({
        first_name: null,
        last_name: null,
        middle_name: null,
        sex: null,
        birth_date: null,
        course: null,
        year: null,
        block: null,
        email: null
    });

    const submit = () => {
        console.log(form);
    }
    const rand = ref(Math.floor(Math.random() * 99999 + 1000));
    watch(form, () => {
        let f = form.first_name ? form.first_name[0] : '';
        let m = form.middle_name ? form.middle_name[0] : '';
        let l = form.last_name ?? '';

        let email = `${f}${m}${l}${rand.value}@edu.ph`.toLocaleLowerCase()

        form.email = email;
    });

</script>

<template>

    <Head title="Register - Student" />
    <div class="container">
        <PageHeading>Register a Student</PageHeading>
        <div class="my-6">
            <form @submit.prevent="submit">
                <div class="md:grid md:grid-cols-2 md:gap-x-6">
                    <!-- <FormInput name="Email" type="email" :error="form.errors.email" v-model="form.email" /> -->
                    <FormInput :error="form.errors.last_name" name="Last Name" v-model="form.last_name" />
                    <FormInput :error="form.errors.first_name" name="First Name" v-model="form.first_name" />
                    <FormInput :error="form.errors.middle_name" name="Middle Name" v-model="form.middle_name" />

                    <InputSelect :error="form.errors.sex" name="Sex" v-model="form.sex">
                        <option :value="null">Select</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </InputSelect>

                    <FormInput :error="form.errors.birth_date" name="Birth Date" type="date"
                        v-model="form.birth_date" />

                    <InputSelect :error="form.errors.course" name="Course" v-model="form.course">
                        <option :value="null">Select</option>
                        <option v-for="course in courses" :key="course.name">{{ course.name }}</option>
                    </InputSelect>

                    <FormInput :error="form.errors.year" name="Year" v-model="form.year" />
                    <FormInput :error="form.errors.block" name="Block" v-model="form.block" />
                    <FormInput :error="form.errors.email" name="Email" type="email" v-model="form.email" />
                </div>
                <div class="my-4 md:flex md:justify-center gap-4 gap-x-6 grid ">
                    <div class="inline-grid md:w-3/12">
                        <DangerButton value="Reset" type="reset" />
                    </div>
                    <div class="inline-grid md:w-3/12">
                        <FormButton value="Register" type="submit" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<style scoped lang="postcss"></style>
