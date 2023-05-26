<script setup>
import VueApexCharts from "vue3-apexcharts";

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

console.log('test');

const chartOptions = {
    labels: labels,
    responsive: [{
        breakpoint: 480,
    }],
};

</script>

<template>
    <div id="chart">
        <VueApexCharts type="donut" width="500" :options="chartOptions" :labels="labels" :series="records"></VueApexCharts>
    </div>
</template>
