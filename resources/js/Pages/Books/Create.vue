<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Link, useForm, usePage } from "@inertiajs/vue3";

const props = defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
    book: {
        type: Object,
    },
});

const user = usePage().props.auth.user;

const form = useForm({
    title: "",
    author: "",
    genre: "",
    description: "",
    isbn: "",
    image: "",
    publisher: "",
});
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Create Book</h2>

            <p class="mt-1 text-sm text-gray-600">Create Book Details</p>
        </header>

        <form
            @submit.prevent="form.post(route('books.store'))"
            class="mt-6 space-y-6"
        >
            <div>
                <InputLabel for="title" value="title" />

                <TextInput
                    id="title"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.title"
                    required
                    autofocus
                    autocomplete="title"
                />

                <InputError class="mt-2" :message="form.errors.title" />
            </div>

            <div>
                <InputLabel for="author" value="author" />

                <TextInput
                    id="author"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.author"
                    required
                    autofocus
                    autocomplete="author"
                />

                <InputError class="mt-2" :message="form.errors.author" />
            </div>

            <div>
                <InputLabel for="genre" value="genre" />

                <TextInput
                    id="genre"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.genre"
                    required
                    autofocus
                    autocomplete="genre"
                />

                <InputError class="mt-2" :message="form.errors.genre" />
            </div>

            <div>
                <InputLabel for="description" value="description" />

                <textarea
                    id="description"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.description"
                    required
                    autofocus
                    autocomplete="description"
                />

                <InputError class="mt-2" :message="form.errors.description" />
            </div>

            <div>
                <InputLabel for="isbn" value="isbn" />

                <TextInput
                    id="isbn"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.isbn"
                    required
                    autofocus
                    autocomplete="isbn"
                />

                <InputError class="mt-2" :message="form.errors.isbn" />
            </div>

            <div>
                <InputLabel for="image" value="image" />

                <TextInput
                    id="image"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.image"
                    required
                    autofocus
                    autocomplete="image"
                />

                <InputError class="mt-2" :message="form.errors.image" />
            </div>

            <div>
                <InputLabel for="publisher" value="publisher" />

                <TextInput
                    id="publisher"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.publisher"
                    required
                    autofocus
                    autocomplete="publisher"
                />

                <InputError class="mt-2" :message="form.errors.publisher" />
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p
                        v-if="form.recentlySuccessful"
                        class="text-sm text-gray-600"
                    >
                        Saved.
                    </p>
                </Transition>
            </div>
        </form>
    </section>
</template>
