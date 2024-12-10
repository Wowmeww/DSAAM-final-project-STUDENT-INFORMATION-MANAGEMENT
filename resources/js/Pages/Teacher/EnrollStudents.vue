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
    query: null
});

const search = ref(props.query);

watch(
    search,
    debounce((q) => {
        router.get(
            route("teacher-enrolled-class.create"),
            { q: q },
            { preserveState: true }
        );
    }, 800)
);
</script>
<template>
    <Head title="Enroll class" />
    <div class="container">
        <h1>Enroll Class</h1>
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
                    <th>Class</th>
                    <th>Students</th>
                    <th v-for="subject in teacher_subjects" :key="subject.id">
                        {{ subject.name }}
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr
                    v-for="student_class in student_classes.data"
                    :key="student_class.id"
                >
                    <td>{{ student_class.name }}</td>
                    <td>{{ student_class.population }}</td>
                    <td
                        v-for="subject in teacher_subjects"
                        :key="subject.id"
                        class="space-x-3"
                    >
                        <Link method="POST" as="button"
                            :href="
                                route('teacher-enrolled-class.store', [
                                    student_class,
                                    subject
                                ])
                            "
                            class="btn-sm bg-blue-500"
                            >Enroll</Link
                        >
                    </td>
                </tr>
            </tbody>
        </PrimaryTable>
        <Pagination :paginator="student_classes" />
    </div>
</template>

<style lang="postcss" scoped></style>
