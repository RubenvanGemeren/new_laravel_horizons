<script setup>
    import { computed, onMounted, ref, watch } from 'vue';
    import ApplicationLogo from '@/Components/ApplicationLogo.vue';
    import FinanceCategoryCreateForm from '@/Components/FinanceCategoryCreateForm.vue';
    import Vue3EasyDataTable from 'vue3-easy-data-table';
    import 'vue3-easy-data-table/dist/style.css';
    import { NTag } from 'naive-ui';
    import tinycolor from 'tinycolor2';
    import axios from 'axios';
    import FinanceCategoryModal from '@/Components/FinanceCategoryModal.vue';

    const props = defineProps({ 
        records: {
            type: Array,
            required: false,
            default: [],
        }, 
        columns: {
            type: Array,
            required: true
        } 
    });

    const data = computed(() => {
        var dataSet = [];

        for (const record of props.records) {
            dataSet.push(Object.values(record));
        }

        return dataSet;

    });

    const searchField = (props.columns).map(item => item.value);
    const searchValue = ref('');

    function getTextColor(color) {
        const formattedColor = tinycolor(color);
        return tinycolor.mostReadable(formattedColor, ['Black', 'White', 'Gray']);
    }

    async function getColorName() {
        const result = await handleColorRequest('#FF0000');
        return result; 
    }

    async function handleColorRequest(color) {
        const formattedColor = color.replace('#', '').slice(0, -2);

        try {
            const response = await axiosRequest('https://www.thecolorapi.com/id?hex=' + formattedColor);

            if (response.status !== 200) {
                return [color, true];
            }

            const colorName = response.data.name.value;
            const accurate = response.data.name.exact_match_name;

            return [colorName, accurate];
        } catch (error) {
            console.error(error);
            return [color, false];
        }
    }

    function axiosRequest(url) {
        return new Promise(function(resolve, reject) {
            axios({
                method: 'get',
                url: url
            })
                .then(response => resolve(response))
                .catch(error => reject(error));
        });
    }

    // console.log(getColorName('#6875F5FF').then(colorName => {
    //     console.log(colorName);
    // })
    // .catch(error => {
    //     console.error(error);
    // }));
    var test = getColorName();

    console.log(test);

    // console.log(test2[]);

</script>

<template>
    <div>
        <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
            <ApplicationLogo class="block h-12 w-auto pb-5" />
            <FinanceCategoryCreateForm/>
        </div>

        <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
            <div>
                <div class="flex items-center pb-5">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="w-6 h-6 stroke-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                    </svg>
                    <h2 class="ml-3 text-xl font-semibold text-gray-900 dark:text-white">
                        <a href="https://laravel.com/docs">Records</a>
                    </h2>
                </div>

                <!-- RECORDS GO HERE -->
                <div style="background-color: white; padding: 1%;">
                    <span>search value: </span>
                    <input type="text" v-model="searchValue">

                    <Vue3EasyDataTable
                        buttons-pagination
                        :headers="columns"
                        :items="records"
                        :search-field="searchField"
                        :search-value="searchValue"
                        :rows-per-page="10"
                        :theme-color="'#6875F5'"
                    >
                        <template #loading>
                            <img
                                src="https://djhjvd1v9hhoj.cloudfront.net/laravel-hologram-lines_3-1.gif"
                                style="width: 100px; height: 80px;"
                            />
                        </template>
                        <template #item-color="color">
                            <n-tag round :bordered="false" :color="{ color: color.color, textColor: getTextColor(color.color) }">
                                {{ color.color }}
                                <!-- {{ getColorName(color.color) }} -->
                            </n-tag>
                        </template>
                        <template #item-operation="item">
                            <div class="operation-wrapper">
                                <FinanceCategoryModal :title="item.name" :record="item" :categories="categories">
                                    <p style="cursor: pointer;">Edit</p>
                                </FinanceCategoryModal>
                            </div>
                        </template>
                    </Vue3EasyDataTable>
                </div>
                
            </div>
        </div>
    </div>
</template>
