<script setup>
import Checkbox from "@/Components/Checkbox.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { onMounted } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

import DataTable from "datatables.net-vue3";

import DataTablesCore from "datatables.net-bs5";

DataTable.use(DataTablesCore);

const props = defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
    columns: {
        type: Array,
    },
    books: {
        type: Object,
    },
});


const columns = props.columns.map((column) => {
    return {
        data: column,
    };
});
const data = props.books.data;
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-scroll shadow-sm sm:rounded-lg">
                    <DataTable
                        class="display"
                        :options="{ data: props.books.data }"
                        :columns="columns"
                    >
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Genre</th>
                                <th>Description</th>
                                <th>isbn</th>
                                <th>image</th>
                                <th>published</th>
                                <th>publisher</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Genre</th>
                                <th>Description</th>
                                <th>isbn</th>
                                <th>image</th>
                                <th>published</th>
                                <th>publisher</th>
                            </tr>
                        </tfoot>
                    </DataTable>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style>
@import "datatables.net-dt";
</style>
