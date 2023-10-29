<script setup>
import Checkbox from "@/Components/Checkbox.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { onMounted, ref } from "vue";
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

let dt = null;
const table = ref();

onMounted(function () {
    dt = table.value.dt;
    dt.on(
        "click",
        "button.editor-delete",
        function (e, child_dt, type, indexes) {
            e.preventDefault();
            let that = this;
            let confirmation = confirm("Confirm removal?");
            let url = e.currentTarget.getAttribute("data-url");
            if (confirmation && url) {
                axios
                    .delete(url, {
                        headers: {
                            "content-type": "application/json",
                        },
                    })
                    .then((res) => {
                        parent = e.currentTarget.parentNode.parentNode;
                        dt.row(parent).remove().draw();
                    });
            }
        }
    );
});
let columns = [...props.columns, "edit", "delete"];

function helloWorld() {
    console.log("hello");
}
columns = columns.map((column) => {
    let obj = {
        data: column,
    };
    if (column == "image") {
        obj.render = function (data, type, row, meta) {
            return `<img src='${data}' />`;
        };
    }

    if (column == "edit") {
        obj.render = function (data, type, row, meta) {
            return `<a target='blank' href='${data}'><button class="bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded">Edit</button></a>`;
        };
    }

    if (column == "delete") {
        obj.render = function (data, type, row, meta) {
            return `<button class="bg-red-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded editor-delete" data-url=${data}>Delete</button>`;
        };
    }
    return obj;
});
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
                        :columns="columns"
                        :ajax="{ url: '/api/books' }"
                        :serverSide="true"
                        :processing="true"
                        ref="table"
                    >
                        <thead>
                            <tr>
                                <th v-for="column in columns" :key="column">
                                    {{ column.data.toUpperCase() }}
                                </th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th v-for="column in columns" :key="column">
                                    {{ column.data.toUpperCase() }}
                                </th>
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
