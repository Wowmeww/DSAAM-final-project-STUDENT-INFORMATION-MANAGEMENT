<script setup>
import PrimaryTable from "@/Components/PrimaryTable.vue";

defineProps({
    student: null,
    grades: null,
});

function gradeRemark($grade) {
    if($grade) {
        if($grade >= 75) return 'Pass';
        else return 'Failed';
    }
    return 'No Grade'
}
</script>
<template>
    <Head title="Grade" />
    <div class="container">
        <h1>Grades</h1>
        <PrimaryTable>
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Teacher</th>
                    <th>Grade</th>
                    <th>Remark</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="grade in grades" :key="grade.id" >
                    <td>{{ grade.subject_name }}</td>
                    <td>{{ grade.teacher_name }}</td>
                    <td>{{ grade.grade }}</td>
                    <td>
                        <span class="badge" :class="{
                            'bg-green-400 text-black': gradeRemark(grade.grade) == 'Pass',
                            'bg-red-400': gradeRemark(grade.grade) == 'Failed',
                            'bg-gray-400': gradeRemark(grade.grade) == 'No Grade',
                            }" >
                            {{ gradeRemark(grade.grade) }}
                        </span>
                    </td>
                </tr>
            </tbody>
        </PrimaryTable>
    </div>
</template>

<style lang="postcss" scoped></style>
