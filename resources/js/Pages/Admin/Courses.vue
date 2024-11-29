<script setup>
    import PageHeading from '@/Components/PageHeading.vue';
    import PrimaryTable from '@/Components/PrimaryTable.vue';
    import TextInput from '@/Components/TextInput.vue';
    import { ref, watch } from 'vue';
    import { debounce } from 'lodash';
    import { router } from '@inertiajs/vue3';

    const props = defineProps({
        courses: Object,
        query: String
    })

    const search = ref(props.query);

    watch(search, debounce((q)=> {
        router.get(route('course.index'), {
            q: q
        }, {
            preserveState: true
        });
    }, 800));
</script>

<template>
    <Head title="Courses" />
    <div class="container">
        <PageHeading>Courses</PageHeading>
        <div class="sm:flex sm:items-center sm:justify-between space-y-2">
            <div class="block md:flex md:items-center md:gap-6">
                <TextInput type="search" v-model="search" class="min-w-96" placeholder="Search" />
            </div>

            <div>
                <Link :href="route('course.create')"
                    class="flex items-center justify-center w-full px-5 py-2 text-sm tracking-wide text-white transition-colors duration-200 bg-blue-500 rounded-lg sm:w-auto gap-x-2 hover:bg-blue-600 dark:hover:bg-blue-500 dark:bg-blue-600">
                Add Course
                </Link>
            </div>
        </div>

        <PrimaryTable>
            <thead>
                <tr>
                    <th>
                        Courses
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(course, i) in courses">
                    <td>
                        {{ course.name }}
                    </td>
                </tr>
            </tbody>
        </PrimaryTable>
    </div>
</template>
