<script setup>
    import Pagination from '@/Components/Pagination.vue';
    import TextInput from '@/Components/TextInput.vue';
    import { debounce } from 'lodash';
    import { ref, watch } from 'vue';
    import { router } from '@inertiajs/vue3';
    import PrimaryTable from '@/Components/PrimaryTable.vue';
    import PageHeading from '@/Components/PageHeading.vue';


    const props = defineProps({
        students: Object,
        query: String
    });

    const search = ref(props.query);
    watch(
        search,
        debounce((q) => {
            router.get(route('student.index'), {
                q: q
            }, {
                preserveState: true
            });
        }, 800)
    );
</script>

<template>
    <section class="container">
        <PageHeading>Students</PageHeading>
        <div class="sm:flex sm:items-center sm:justify-between space-y-2">
            <div class="block md:flex md:items-center md:gap-6">
                <TextInput type="search" v-model="search" class="min-w-96" placeholder="Search" />
            </div>

            <div>
                <Link :href="route('student.create')"
                    class="flex items-center justify-center w-full px-5 py-2 text-sm tracking-wide text-white transition-colors duration-200 bg-blue-500 rounded-lg sm:w-auto gap-x-2 hover:bg-blue-600 dark:hover:bg-blue-500 dark:bg-blue-600">
                Add Student
                </Link>
            </div>
        </div>

        <PrimaryTable>
            <thead>
                <tr>
                    <th>
                        ID
                    </th>
                    <th>
                        Name
                    </th>

                    <th>
                        Course
                    </th>

                    <th>
                        Year
                    </th>

                    <th>
                        Block
                    </th>
                    <th>
                        Email
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="student in students.data">
                    <td>
                        {{ student.id }}
                    </td>
                    <td>
                        {{ `${student.last_name} ${student.first_name} ${student.middle_name[0]}.` }}
                    </td>
                    <td>
                        {{ student.course }}
                    </td>
                    <td>
                        {{ student.year }}
                    </td>
                    <td>
                        {{ student.block }}
                    </td>
                    <td>
                        {{ student.user.email }}
                    </td>
                </tr>
            </tbody>
        </PrimaryTable>

        <Pagination :paginator="students" />
    </section>
</template>
