<script setup>
    import Pagination from '@/Components/Pagination.vue';
    import TextInput from '@/Components/TextInput.vue';
    import { debounce } from 'lodash';
    import { ref, watch } from 'vue';
    import { router } from '@inertiajs/vue3';

    const props = defineProps({
        students: Object,
        query: String
    });

    const search = ref(props.query);
    watch(
        search,
        debounce((q) => {
            router.get(route('admin.students'), {
                q: q
            }, {
                preserveState: true
            });
        }, 800)
    );
</script>

<template>
    <section class="container">
        <div class="sm:flex sm:items-center sm:justify-between">
            <div class="block md:flex md:items-center md:gap-6">
                <h2 class="text-lg font-medium text-gray-800 dark:text-white">Students</h2>
                <TextInput type="search" v-model="search" class="min-w-96" placeholder="Search" />
            </div>

            <div class="flex items-center mt-4 gap-x-3">

                <Link :href="route('admin.add-student')"
                    class="flex items-center justify-center w-full px-5 py-2 text-sm tracking-wide text-white transition-colors duration-200 bg-blue-500 rounded-lg sm:w-auto gap-x-2 hover:bg-blue-600 dark:hover:bg-blue-500 dark:bg-blue-600">
                    Add Student
                </Link>
            </div>
        </div>

        <div class="flex flex-col mt-6">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-800">
                                <tr>
                                    <th scope="col"
                                        class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                        ID
                                    </th>
                                    <th scope="col"
                                        class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                        Name
                                    </th>

                                    <th scope="col"
                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                        Course
                                    </th>

                                    <th scope="col"
                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                        Year
                                    </th>

                                    <th scope="col"
                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                        Block
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                                <tr v-for="student in students.data">
                                    <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                        {{ student.id }}
                                    </td>
                                    <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                        {{ `${student.last_name} ${student.first_name} ${student.middle_name[0]}.` }}
                                    </td>
                                    <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                        {{ student.course }}
                                    </td>
                                    <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                        {{ student.year }}
                                    </td>
                                    <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                        {{ student.block }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <Pagination :paginator="students" />
    </section>
</template>

<style lang="postcss" scoped></style>
