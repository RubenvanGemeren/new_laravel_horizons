<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import Welcome from '@/Components/Welcome.vue';
    import FinanceList from '@/Components/FinanceList.vue';
    import { defineProps } from 'vue';

    const props = defineProps({
        records: {
            type: Array,
            required: true,
        },
    });

    const records = props.records;

    console.log(records.id);

    // headers = records[0].keys();
    // console.log(headers);

</script>

<template>
    <AppLayout title="Finance">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Finance test view
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <FinanceList :records="records" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
