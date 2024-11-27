<script setup>
    import { usePage } from '@inertiajs/vue3';
    import { ref } from 'vue';
    import NavLink from './NavLink.vue';

    const user = usePage().props.auth.user;
    const isOpen = ref(false);
    const usersAccess = user.access_type;

    defineEmits(['logout']);
</script>


<template>

    <nav>
        <div class="container px-6 py-4 mx-auto">
            <div class="lg:flex lg:items-center lg:justify-between">
                <div class="flex items-center justify-between">
                    <a href="#">
                        <i class="bi-github"></i>
                    </a>

                    <!-- Mobile menu button -->
                    <div class="flex lg:hidden">
                        <button v-cloak @click="isOpen = !isOpen" type="button" class="mobileMenuButton "
                            aria-label="toggle menu">
                            <svg v-show="!isOpen" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 8h16M4 16h16" />
                            </svg>

                            <svg v-show="isOpen" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Mobile Menu open: "block", Menu closed: "hidden" -->
                <div v-cloak :class="[isOpen ? 'translate-x-0 opacity-100 ' : 'opacity-0 -translate-x-full']"
                    class=" responsiveNavLinkContainer">

                    <!-- ADMIN -->
                    <div v-if="usersAccess == 'admin'" class="flex flex-col -mx-6 lg:flex-row lg:items-center lg:mx-8">
                        <NavLink :href="route('admin.dashboard')" label="Dashboard"
                            :active="$page.component == 'Admin/Dashboard'" />
                        <NavLink :href="route('student.index')" label="Students"
                            :active="$page.component == 'Admin/Students'" />
                        <NavLink :href="route('teacher.index')" label="Teachers"
                            :active="$page.component == 'Admin/Teachers'" />
                        <NavLink :href="route('admin.courses')" label="Courses"
                            :active="$page.component == 'Admin/Courses'" />
                        <NavLink :href="route('admin.subjects')" label="Subjects"
                            :active="$page.component == 'Admin/Subjects'" />
                    </div>

                    <div v-if="usersAccess == 'teacher'"
                        class="flex flex-col -mx-6 lg:flex-row lg:items-center lg:mx-8">
                        <NavLink :href="route('teacher.dashboard')" label="Dashboard"
                            :active="$page.component == 'Teacher/Dashboard'" />
                        <NavLink :href="route('teacher.handled-classes')" label="Handled Classes"
                            :active="$page.component == 'Teacher/HandledClasses'" />
                        <NavLink :href="route('teacher.submit-grades')" label="Submit Grades"
                            :active="$page.component == 'Teacher/SubmitGrades'" />
                        <NavLink :href="route('teacher.enroll-students')" label="Enroll Students"
                            :active="$page.component == 'Teacher/EnrollStudents'" />
                    </div>

                    <div v-if="usersAccess == 'student'"
                        class="flex flex-col -mx-6 lg:flex-row lg:items-center lg:mx-8">
                        <NavLink :href="route('student.dashboard')" label="Dashboard"
                            :active="$page.component == 'Student/Dashboard'" />
                        <NavLink :href="route('student.grades')" label="Grades"
                            :active="$page.component == 'Student/Grades'" />
                    </div>

                    <div
                        class="flex sm:items-center mt-4 lg:mt-0 sm:justify-between gap-5 sm:gap-10 sm:flex-row flex-col items-start">
                        <!-- <button
                            class="hidden mx-4 text-gray-600 transition-colors duration-300 transform lg:block dark:text-gray-200 hover:text-gray-700 dark:hover:text-gray-400 focus:text-gray-700 dark:focus:text-gray-400 focus:outline-none"
                            aria-label="show notifications">
                            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M15 17H20L18.5951 15.5951C18.2141 15.2141 18 14.6973 18 14.1585V11C18 8.38757 16.3304 6.16509 14 5.34142V5C14 3.89543 13.1046 3 12 3C10.8954 3 10 3.89543 10 5V5.34142C7.66962 6.16509 6 8.38757 6 11V14.1585C6 14.6973 5.78595 15.2141 5.40493 15.5951L4 17H9M15 17V18C15 19.6569 13.6569 21 12 21C10.3431 21 9 19.6569 9 18V17M15 17H9"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </button> -->
                        <button type="button" class="flex items-center focus:outline-none w-full lg:w-fit"
                            aria-label="toggle profile dropdown">
                            <div
                                class="w-9 h-9 overflow-hidden border-2 border-gray-400 rounded-full grid place-items-center">
                                <!-- <img src="#"
                                    class="object-cover w-full h-full" alt="avatar"> -->
                                <i class="bi-person-fill text-2xl"></i>
                            </div>

                            <h3
                                class="mx-2 text-gray-700 dark:text-gray-200 lg:hidden leading-tight flex flex-col text-start">
                                <span>User Full Name</span>
                                <small>user.email.mail@com</small>
                            </h3>
                        </button>
                        <button type="button" @click="$emit('logout')"
                            class="btn btn-primary justify-center w-full sm:w-fit">
                            Log Out
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </nav>

</template>

<style lang="postcss" scoped>
    nav {
        @apply relative bg-white shadow dark:bg-gray-800;
    }

    .mobileMenuButton {
        @apply text-gray-500 dark:text-gray-200 hover:text-gray-600 dark:hover:text-gray-400 focus:outline-none focus:text-gray-600 dark:focus:text-gray-400;
    }

    .responsiveNavLink {
        @apply px-3 py-2 mx-3 mt-2 text-gray-700 transition-colors duration-300 transform rounded-md lg:mt-0 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700;
    }

    .responsiveNavLinkContainer {
        @apply absolute inset-x-0 z-20 w-full px-6 py-4 transition-all duration-300 ease-in-out bg-white dark:bg-gray-800 lg:mt-0 lg:p-0 lg:top-0 lg:relative lg:bg-transparent lg:w-auto lg:opacity-100 lg:translate-x-0 lg:flex lg:items-center;
    }

    .active {
        @apply bg-gray-100 dark:bg-gray-700;
    }
</style>
