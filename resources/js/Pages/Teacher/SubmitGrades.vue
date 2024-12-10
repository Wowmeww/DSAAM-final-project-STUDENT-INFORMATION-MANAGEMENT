<script setup>

import { router, useForm } from "@inertiajs/vue3";
import InputSelect from "@/Components/InputSelect.vue";
import PrimaryTable from "@/Components/PrimaryTable.vue";
import FormButton from "@/Components/FormButton.vue";
import InputError from "@/Components/InputError.vue";
import { ref, watch } from "vue";
const props = defineProps({
    teacher: null,
    classes: null,
    students: null,
    subject: null,
});

const filterClass = ref(null);

const gradesForm = useForm({
    students: [],
});

function changeGrade(grade, student) {
    const students = gradesForm.students;
    students.push({
        student_id: student.id,
        subject_id: props.subject.id,
        teacher_id: props.teacher.id,
        grade: grade,
    });
    students.forEach((v, i, arr) => {
        let li = arr.findLastIndex((v) => v.student_id == student.id);
        let fi = arr.findIndex((v) => v.student_id == student.id);
        if ((li !== fi && v.student_id == student.id) || !v.grade) {
            arr.splice(i, 1);
        }
    });
}

function grade(student) {
    if (student) {
        let grd = student.grades.find(
            (grade) => grade.subject_id == props.subject.id
        );
        return grd ? grd.grade : "";
    }
}
function submitGrades() {
    gradesForm.patch(route("grade.patch"));
}

watch(filterClass, (class_model) => {
    router.get(route("grade.edit"), {
        class: class_model.class_id,
        subject: class_model.subject_id,
    });
});
</script>
<template>
    <Head title="Submit/Edit Grades" />
    <div class="container pb-6">
        <h1>Submit/Edit Grades</h1>
        <div class="sm:flex sm:items-center sm:justify-between space-y-2 mt-5">
            <div class="md:w-4/12">
                <InputSelect name="Filter Class" v-model="filterClass">
                    <option :value="null" selected>Select Class</option>
                    <option
                        v-for="class_model in classes"
                        :value="class_model"
                        :key="class_model.class_id"
                    >
                        {{ class_model.class_name }} -
                        {{ class_model.subject_name }}
                    </option>
                </InputSelect>
            </div>
            <h1 v-if="subject" >Subject: <span class="underline underline-offset-4" >{{ subject.name }}</span></h1>
        </div>
        <div v-if="students" class="mt-4">
            <PrimaryTable>
                <thead>
                    <tr>
                        <th>Student</th>
                        <th>Course</th>
                        <th>Grade</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="student in students" :key="student.id">
                        <td>{{ student.full_name }}</td>
                        <td>{{ student.course }}</td>
                        <td>
                            <input
                                type="number"
                                class="dark:bg-gray-50/15 border-0 w-[70px] rounded-sm"
                                min="0"
                                max="100"
                                :value="grade(student)"
                                @input="
                                    changeGrade($event.target.value, student)
                                "
                            />
                        </td>
                    </tr>
                </tbody>
            </PrimaryTable>
            <div class="py-6 flex justify-center">
                <section class="grid justify-center" v-if="students">
                    <FormButton
                        value="Submit Grades"
                        :disabled="gradesForm.processing"
                        @click="submitGrades"
                    />
                    <InputError :message="gradesForm.errors.grades" />
                </section>
            </div>
        </div>
    </div>
</template>
