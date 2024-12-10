<script setup>
import PrimaryTable from "@/Components/PrimaryTable.vue";
import TextInput from "@/Components/TextInput.vue";
import { ref, watch } from "vue";
import { debounce } from "lodash";
import { router } from "@inertiajs/vue3";
import Pagination from "@/Components/Pagination.vue";

const props = defineProps({
    teacher: Object,
    teacher_subjects: Object,
    student_classes: Object,
    teacher_classes: Object,
});

const search = ref(null);

watch(
    search,
    debounce((q) => {
        router.get(
            route("teacher-enrolled-class.edit"),
            { q: q },
            { preserveState: true }
        );
    }, 800)
);
</script>
<template>
    <Head title="Teacher - Classes" />
    <div class="container pb-6">
        <h1>Handled class</h1>
        <div class="sm:flex sm:items-center sm:justify-between space-y-2">
            <div class="block md:flex md:items-center md:gap-6">
                <TextInput
                    type="search"
                    v-model="search"
                    class="min-w-96"
                    placeholder="Search"
                />
            </div>
        </div>
        <PrimaryTable>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Class</th>
                    <th>Students</th>
                    <th>Subject</th>
                    <th>Un-enroll</th>
                </tr>
            </thead>
            <tbody>
                <tr
                    v-for="teacher_class in teacher_classes"
                    :key="teacher_class.id"
                >
                    <td>{{ teacher_class.id }}</td>
                    <td>{{ teacher_class.class_name }}</td>
                    <td>{{ teacher_class.population }}</td>
                    <td>{{ teacher_class.subject_name }}</td>
                    <td>
                        <Link
                            :href="
                                route('teacher-enrolled-class.destroy', [
                                    teacher_class,
                                ])
                            "
                            method="DELETE"
                            as="button"
                            class="btn-sm bg-slate-700/70"
                            >Un-enroll</Link
                        >
                    </td>
                </tr>
            </tbody>
        </PrimaryTable>
    </div>
</template>

<style lang="postcss" scoped></style>
