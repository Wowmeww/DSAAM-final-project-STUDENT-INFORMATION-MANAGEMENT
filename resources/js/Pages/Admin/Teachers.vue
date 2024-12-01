<script setup>
    import PageHeading from '@/Components/PageHeading.vue';
    import Pagination from '@/Components/Pagination.vue';
    import PrimaryTable from '@/Components/PrimaryTable.vue';
    import TextInput from '@/Components/TextInput.vue';
    import { ref, watch } from 'vue';
    import { debounce } from 'lodash';
    import { router } from '@inertiajs/vue3';


    const props = defineProps({
        teachers: Object,
        query: String
    })

    const search = ref(props.query);
    const subjects = (subjects) => {
        const subs = [];
        subjects.forEach(subject => {
            subs.push(subject.name);
        });
        return subs.join(', ');
    }

    watch(search, debounce((q) => {
        router.get(route('teacher.index'), {
            q: q
        }, {
            preserveState: true
        });
    }, 800));
</script>

<template>

    <Head title="Teachers" />
    <div class="container">
        <PageHeading>Teachers</PageHeading>
        <div class="sm:flex sm:items-center sm:justify-between space-y-2">
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
                        Email
                    </th>
                    <th colspan="2">
                        Subjects
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
                        {{ teacher.user.email }}
                    </td>
                    <td class="text-wrap">
                        {{ subjects(teacher.subjects) }}
                    </td>
                    <td>
                        <Link :href="route('teacher.edit', {teacher})" v-html="'Edit Subjects'" class="rounded-md font-semibold border-gray-50/15 bg-yellow-400/10 hover:bg-white/10 border p-1" />
                    </td>
                </tr>
            </tbody>
        </PrimaryTable>

        <Pagination :paginator="teachers" />

    </div>
</template>
