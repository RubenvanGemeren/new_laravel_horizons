<script setup>
import { computed, onMounted, ref, watch } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import SimpleDonutChart from '@/Components/SimpleDonutChart.vue';

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
    <div>
        <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
            <ApplicationLogo class="block h-12 w-auto pb-5" />
            <h2 class="ml-3 text-xl font-semibold text-gray-900 dark:text-white">
                This is where the various charts are being shown
                {{ records }}
            </h2>
        </div>

        <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
            <div>
                <div class="flex items-center pb-5">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="w-6 h-6 stroke-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                    </svg>
                    <h2 class="ml-3 text-xl font-semibold text-gray-900 dark:text-white">
                        <a href="https://laravel.com/docs">Charts</a>
                    </h2>
                </div>

                <!-- CHARTS GO HERE -->
               <simple-donut-chart :records="records" :labels="labels" />
                
            </div>
        </div>
    </div>
</template>
