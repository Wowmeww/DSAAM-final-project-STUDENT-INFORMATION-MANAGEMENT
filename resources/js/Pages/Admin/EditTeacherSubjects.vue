<script setup>
    import FormButton from '@/Components/FormButton.vue';
    import PageHeading from '@/Components/PageHeading.vue';
    import PrimaryCheckbox from '@/Components/PrimaryCheckbox.vue';

    import { useForm } from '@inertiajs/vue3';

    const props = defineProps({
        teacher: Object,
        teacherName: String,
        subjects: Object,
    })

    const form = useForm({
        subjects: []
    })


    props.subjects.forEach(sub => {
        props.teacher.subjects.forEach(checkedSub => {
            if (sub.id == checkedSub.id) {
                sub.checked = true;
                form.subjects.push(sub.id);
            }
        });
    });

    ;

    const submit = () => {
        form.patch(route('teacher.update', { teacher: props.teacher }));
    }

    const addSubject = (e) => {
        if (e.checked) {
            form.subjects.push(Number(e.value));
        }
        else {
            form.subjects = form.subjects.filter((sub_id) => sub_id != e.value);
        }
    }


</script>
<template>

    <Head title="Edit Handled Subjects" />
    <form class="container" @submit.prevent="submit">
        <PageHeading>Handled Subject/s</PageHeading>
        <h2>Teacher: {{ teacherName }}</h2>
        <fieldset class="col-span-full">

            <div class="grid md:grid-cols-2  lg:grid-cols-3 mt-4">
                <!-- <div v-for="subject in subjects">
                    <input type="checkbox" :checked="subject.checked" :id="subject.name" @change="addSubject"
                        :value="subject.id" />
                    <label :for="subject.name">{{ subject.name }}</label>
                </div> -->
                <PrimaryCheckbox v-for="subject in subjects" :key="subject.id" :checked="subject.checked"
                    :value="subject.id" :label="subject.name" @changed="addSubject" />
            </div>
        </fieldset>
        <div class="my-4 ">
            <div class="flex justify-center space-x-3">
                <Link :href="route('teacher.index')"
                    class="px-4 py-2 border rounded-lg border-gray-50/65 font-semibold hover:bg-gray-100/25">Back</Link>
                <FormButton value="Update" type="submit" :disabled="form.processing" />
            </div>
        </div>
    </form>
</template>

<style lang="postcss" scoped></style>
