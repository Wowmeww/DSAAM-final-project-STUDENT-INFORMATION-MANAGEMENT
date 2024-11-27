<script setup>
    import PageHeading from '@/Components/PageHeading.vue';
import Pagination from '@/Components/Pagination.vue';
import PrimaryTable from '@/Components/PrimaryTable.vue';
    import TextInput from '@/Components/TextInput.vue';
    import { ref } from 'vue';

    defineProps({
        teachers: Object
    })

    const search = ref(null);
</script>

<template>

    <Head title="Teachers" />
    <div class="container">
        <PageHeading>Teachers</PageHeading>
        <div class="sm:flex sm:items-center sm:justify-between">
            <div class="block md:flex md:items-center md:gap-6">
                <TextInput type="search" v-model="search" class="min-w-96" placeholder="Search" />
            </div>

            <div>
                <Link :href="route('teacher.create')"
                    class="flex items-center justify-center w-full px-5 py-2 text-sm tracking-wide text-white transition-colors duration-200 bg-blue-500 rounded-lg sm:w-auto gap-x-2 hover:bg-blue-600 dark:hover:bg-blue-500 dark:bg-blue-600">
                Add Teacher
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
                        Subject/s
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="teacher in teachers.data">
                    <td>
                        {{ teacher.id }}
                    </td>
                    <td>
                        {{ `${teacher.last_name} ${teacher.first_name} ${teacher.middle_name[0]}.` }}
                    </td>
                    <td>
                        Subs
                    </td>
                </tr>
            </tbody>
        </PrimaryTable>

        <Pagination :paginator="teachers" />

    </div>
</template>
