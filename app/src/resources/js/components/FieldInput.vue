<script setup>
import { watch } from "vue";
import FormError from "@/components/FormError.vue";
import Button from "./Button.vue";

const model = defineModel({
    default: () => ({
        singleFields: {},
        tableFields: [],
    }),
});

const addRow = (groupIndex) => {
    if (!Array.isArray(model.value.tableFields[groupIndex])) {
        model.value.tableFields[groupIndex] = [];
    }

    const newRow = {};
    for (const field of Object.keys(model.value.tableFields[groupIndex][0] ?? {})) {
        newRow[field] = "";
    }
    model.value.tableFields[groupIndex].push(newRow);
};

const removeRow = (groupIndex, rowIndex) => {
    if (
        Array.isArray(model.value.tableFields[groupIndex]) &&
        model.value.tableFields[groupIndex].length > 1
    ) {
        model.value.tableFields[groupIndex].splice(rowIndex, 1);
    }
};

watch(
    () => model.value.tableFields,
    (newTableFields) => {
        if (Array.isArray(newTableFields) && newTableFields.length > 0) {
            newTableFields.forEach((group, index) => {
                if (!Array.isArray(model.value.tableFields[index]) || model.value.tableFields[index].length === 0) {
                    addRow(index);
                }
            });
        }
    },
    { immediate: true, deep: true }
);
</script>

<template>
    <div v-if="Object.keys(model.singleFields).length || model.tableFields.length" class="mb-4">
        <h3 class="text-lg font-medium text-gray-700 mb-4">入力フィールド:</h3>
        <div v-if="Object.keys(model.singleFields).length" class="m-6 p-6 rounded-lg shadow">
            <h4 class="text-md font-medium text-gray-600 border-b pb-2 mb-4">単一フィールド：</h4>
            <div class="grid grid-cols-2 gap-4">
                <div v-for="(value, field) in model.singleFields" :key="field"
                    class="flex items-center space-x-2 min-w-0">
                    <label :for="`single-field-${field}`" class="text-sm font-medium text-gray-600 whitespace-nowrap">
                        {{ field }}
                    </label>
                    <textarea v-model="model.singleFields[field]" :id="`single-field-${field}`" type="text"
                        class="flex-1 min-w-0 p-1 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" />
                    <FormError v-if="model.errors?.[`singleFields.${field}`]"
                        :error="model.errors[`singleFields.${field}`][0]" />
                </div>
            </div>
        </div>

        <div v-if="model.tableFields.length" class="m-6 p-6 rounded-lg shadow">
            <h4 class="text-md font-medium text-gray-600 border-b pb-2 mb-4">テーブルフィールド：</h4>
            <div v-for="(fieldGroup, groupIndex) in model.tableFields" :key="groupIndex"
                class="m-6 p-6 rounded-lg shadow">
                <h5 class="text-md font-medium text-gray-600 mt-2">
                    テーブル：{{ groupIndex + 1 }}
                </h5>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 mb-4">
                        <thead>
                            <tr>
                                <th v-for="(field, index) in Object.keys(fieldGroup[0] ?? {})" :key="index"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                    {{ field }}
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                    操作
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="(row, rowIndex) in model.tableFields[groupIndex]" :key="rowIndex">
                                <td v-for="(fieldValue, field) in row" :key="field" class="px-6 py-4 whitespace-nowrap">
                                    <textarea v-model="model.tableFields[groupIndex][rowIndex][field]" type="text"
                                        class="w-16 p-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" />
                                    <FormError v-if="model.errors?.[`tableFields.${groupIndex}.${rowIndex}.${field}`]"
                                        :error="model.errors[`tableFields.${groupIndex}.${rowIndex}.${field}`][0]" />
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <Button :text="'X'" :onClick="() => removeRow(groupIndex, rowIndex)"
                                        class="bg-gradient-to-r from-red-600 to-red-800 text-white font-semibold px-2 text-center shadow-md hover:scale-105 transform transition duration-300" />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <Button :text="'+'" :onClick="() => addRow(groupIndex)"
                    class="bg-gradient-to-r from-green-600 to-green-800 text-center text-white font-semibold px-4 py-1 shadow-md hover:scale-105 transform transition duration-300" />
            </div>
        </div>
    </div>
</template>
