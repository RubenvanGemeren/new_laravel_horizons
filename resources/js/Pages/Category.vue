<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import FinanceCategoryList from '@/Components/FinanceCategoryList.vue';
    import ToastMessage from '@/Components/ToastMessage.vue';
    import { computed, onMounted, ref, watch } from 'vue';
    import { usePage } from '@inertiajs/vue3'
    
    const props = defineProps({
        records: {
            type: Array,
            required: true,
        },
        columns: {
            type: Array,
            required: true,
        },
    });

    const page = usePage();
    
    const records = computed(() => {
        return props.records;
    });

    const columns = props.columns;

</script>

<template>
    <AppLayout title="Category">
        <template #header>
            <ToastMessage v-if="$page.props.flash.toast" :message="$page.props.flash.toast[1]" :severity="$page.props.flash.toast[0]" :unix="$page.props.flash.toast[2]"></ToastMessage>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Categories
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <FinanceCategoryList :columns="columns" :records="records" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>