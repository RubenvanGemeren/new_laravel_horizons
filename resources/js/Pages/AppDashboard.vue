<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import DashboardLayout from '@/Components/DashboardLayout.vue';


const props = defineProps({
    records: {
        type: Array,
        required: true
    },
    labels: {
        type: Array,
        required: true
    },
});

const records = props.records;
const labels = props.labels;

</script>



<template>
    <AppLayout title="Home">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Dashboard
                {{ records + labels }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <DashboardLayout :records="records" :labels="labels" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
