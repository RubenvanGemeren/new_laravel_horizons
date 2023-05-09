<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import FinanceList from '@/Components/FinanceList.vue';
    import ToastMessage from '@/Components/ToastMessage.vue';
    import { computed, onMounted, ref } from 'vue';

    const props = defineProps({
        records: {
            type: Array,
            required: true,
        },
        columns: {
            type: Array,
            required: true,
        },
        toast: {
            type: Array,
            required: false,
        }
    });

    const records = computed(() => {
        return props.records;
    })

    const toast = computed(() => {
        return props.toast;
    })

    const columns = props.columns;

</script>

<template>
    <AppLayout title="Finance">
        <template #header>
            <ToastMessage v-if="toast" :message="toast[1]" :severity="toast[0]"></ToastMessage>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Finance test view
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <FinanceList :columns="columns" :records="records" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>