<script setup>
import { useForm } from "@inertiajs/vue3";
import SecondaryInput from "@/Components/SecondaryInput.vue";

import FormCard from "@/Components/Card/FormCard.vue";
import CardSubmitButton from "@/Components/Card/CardSubmitButton.vue";
import CardTitle from "@/Components/Card/CardTitle.vue";

const props = defineProps({
    user: Object,
    account_owner: Object,
});

const form = useForm({
    last_name: props.account_owner.last_name,
    first_name: props.account_owner.first_name,
    middle_name: props.account_owner.middle_name,
    sex: props.account_owner.sex,
    birth_date: new Date(props.account_owner.birth_date)
        .toLocaleDateString("en-ZA")
        .replaceAll("/", "-"),
});

const resetPassword = useForm({
    old_password: null,
    password: null,
    password_confirmation: null,
    email: props.user.email,
});

function changePassword() {
    resetPassword.post(route("password.change", { user: props.user }), {
        onSuccess: () => resetPassword.reset(),
        preserveScroll:
            resetPassword.errors.old_password || resetPassword.errors.password,
        onError: () => resetPassword.reset("password", "password_confirmation"),
    });
}

function updateProfile() {
    form.patch(route("profile", { user: props.user }));
}
</script>
<template>
    <Head title="Profile" />
    <!-- <FormCard>
        <form method="post" enctype="multipart/form-data">
            <CardTitle value="Profile Picture" />
            <div
                class="w-full rounded-sm bg-cover bg-center bg-no-repeat items-center"
            >
                <div
                    :style="
                        profilePreview
                            ? `background-image: url('${profilePreview}');`
                            : ''
                    "
                    class="mx-auto flex justify-center w-[141px] h-[141px] bg-blue-300/20 rounded-full bg-cover bg-center bg-no-repeat"
                >
                    <div
                        class="bg-white/90 rounded-full w-6 h-6 text-center ml-28 mt-4"
                    >
                        <input
                            @input="profileChanged"
                            type="file"
                            id="upload_profile"
                            name="image"
                            hidden
                        />

                        <label for="upload_profile" class="cursor-pointer">
                            <svg
                                data-slot="icon"
                                class="w-6 h-5 text-blue-700"
                                fill="none"
                                stroke-width="1.5"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg"
                                aria-hidden="true"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z"
                                ></path>
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z"
                                ></path>
                            </svg>
                        </label>
                    </div>
                </div>
            </div>
            <h2 class="text-center mt-1 font-semibold dark:text-gray-300">
                Upload Profile Image
            </h2>
            <CardSubmitButton
                value="Update"
            />
        </form>
    </FormCard> -->
    <FormCard v-if="user.access_type !== 'admin'">
        <CardTitle value="Profile" />
        <form @submit.prevent="updateProfile">
            <div v-if="user.access_type !== 'admin'" class="grid w-full">
                <SecondaryInput
                    v-model="form.first_name"
                    label="First Name"
                    :error="form.errors.first_name"
                />
                <SecondaryInput
                    v-model="form.last_name"
                    label="Last Name"
                    :error="form.errors.last_name"
                />
                <SecondaryInput
                    v-model="form.middle_name"
                    label="Middle Name"
                    :error="form.errors.middle_name"
                />
            </div>

            <div
                v-if="user.access_type !== 'admin'"
                class="grid md:grid-cols-2 xs:flex-col gap-2 w-full"
            >
                <SecondaryInput
                    v-model="form.sex"
                    label="Sex"
                    type="select"
                    :options="['male', 'female']"
                    :error="form.errors.sex"
                />
                <SecondaryInput
                    v-model="form.birth_date"
                    type="date"
                    label="Date of Birth"
                    :error="form.errors.birth_date"
                />
            </div>

            <CardSubmitButton value="Update" :disabled="form.processing" />
        </form>
    </FormCard>

    <FormCard>
        <form @submit.prevent="changePassword">
            <CardTitle value="Change Password" />

            <SecondaryInput
                label="Old Password"
                v-model="resetPassword.old_password"
                :error="resetPassword.errors.old_password"
            />
            <SecondaryInput
                label="New Password"
                v-model="resetPassword.password"
                :error="resetPassword.errors.password"
            />
            <SecondaryInput
                label="Confirm Password"
                v-model="resetPassword.password_confirmation"
                :error="resetPassword.errors.password_confirmation"
            />

            <CardSubmitButton
                value="Update"
                :disabled="resetPassword.processing"
            />
        </form>
    </FormCard>
</template>
