<script setup>
    import DangerButton from '@/Components/DangerButton.vue';
    import FormButton from '@/Components/FormButton.vue';
    import FormInput from '@/Components/FormInput.vue';
    import InputSelect from '@/Components/InputSelect.vue';
    import PageHeading from '@/Components/PageHeading.vue';
    import PrimaryCheckbox from '@/Components/PrimaryCheckbox.vue';
    import { useForm } from '@inertiajs/vue3';
    import { ref, watch } from 'vue';


    const props = defineProps({
        subjects: Object
    });

    const form = useForm({
        first_name: null,
        last_name: null,
        middle_name: null,
        sex: null,
        birth_date: null,
        email: null,
        password: Math.floor(Math.random() * 99999) + 10000,
        subjects: []
    });

    watch(form, () => {
        let f = form.first_name ? form.first_name[0] : '';
        let m = form.middle_name ? form.middle_name[0] : '';
        let l = form.last_name ?? '';

        let email = `${f}${m}${l}${form.password}@edu.ph`.toLocaleLowerCase()

        form.email = form.email = email.replace(' ', '');
    });

    const submit = () => {
        form.post(route('teacher.store'));
    }
    const addSubject = (e) => {
        console.log(e);
        if (e.checked) {
            form.subjects.push(e.value);
        }
        else {
            form.subjects = form.subjects.filter((sub_id) => sub_id != e.value);
        }
    }
</script>
<template>
    <div class="container">
        <PageHeading>Register a Teacher</PageHeading>
        <div class="my-6">
            <form @submit.prevent="submit">
                <div class="md:grid md:grid-cols-2 md:gap-x-6">
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
                    <div @click="form.password = Math.floor(Math.random() * 99999) + 10000"
                        class="flex items-center relative">
                        <div class="flex-1">
                            <FormInput :error="form.errors.email" name="Email" type="email" v-model="form.email"
                                disabled />
                        </div>
                        <i class="bi-dice-5 absolute cursor-pointer right-3 top-[53%]"
                            :class="{ 'top-[40%]': form.errors.email }"> </i>
                    </div>

                    <fieldset class="col-span-full">
                        <legend>Handled Subject/s</legend>
                        <div class="grid md:grid-cols-2  lg:grid-cols-3">
                            <PrimaryCheckbox v-for="subject in subjects" :key="subject.id" :value="subject.id" :label="subject.name"
                                @changed="addSubject"  />
                            <!-- <div v-for="subject in subjects">
                                <input type="checkbox" :id="subject.name" @change="addSubject" :value="subject.id" />
                                <label :for="subject.name">{{ subject.name }}</label>
                            </div> -->
                        </div>
                    </fieldset>

                </div>
                <div class="my-5 md:flex md:justify-center gap-4 gap-x-6 grid ">
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
