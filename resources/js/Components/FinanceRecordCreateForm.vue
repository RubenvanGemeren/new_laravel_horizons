<script setup>
import { ref, computed } from 'vue';
import { Head, Link, router, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Dropdown from '@/Components/Dropdown.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import SelectDropdown from '@/Components/SelectDropdown.vue';
import { pageHeaderProps } from 'naive-ui';

const props = defineProps({
    record: {
        type: Object,
        default: {},
    },
    categories: {
        type: Array,
        required: true,
    }
});

const emit = defineEmits(['closeModal']);

let showRecord = JSON.stringify(props.record) !== "{}";

let formRef = ref(null);

let submitType = ref(null);

const today = new Date().toISOString().substring(0, 10);

console.log(today.toString());

const form = useForm({
    date: props.record['date'] ? (props.record['date'].split(" "))[0] : today,
    name: props.record['name'] ?? '',
    type: props.record['type'] ?? '',
    category_id: props.record['category_id'] ?? '',
    description: props.record['description'] ?? '',
    amount: props.record['amount'] ? (props.record['amount'] / 100).toString() : '',
    effective_date: props.record['effective_date'] ? (props.record['effective_date'].split(" "))[0] : today,
},{
        initialFormValues: formRef,
});

const submit = () => {

    switch (submitType.value) {
        case 'update':
            form.patch(route('finance' + '.' + submitType.value, props.record), {
                preserveScroll: true,
            });
            break;
        case 'destroy':
            form.delete(route('finance' + '.' + submitType.value, props.record), {
                preserveScroll: true,
                onSuccess: () => {
                    closeModal();
                    form.reset();
                },
            });
            break;
            
        default:
            form.post(route('finance' + '.' + submitType.value), {
                preserveScroll: true,
                onSuccess: () => {
                    form.reset();
                },
            });
            break;
    }
};

const optionsType = ['Income', 'Expense', 'Saving'];

const optionsCategory = computed(() => {
    return props.categories;
    // var dataSet = [];

    // for (const category of props.categories) {
    //     console.log(category);
    //     dataSet.push(category);
    // }

    // return dataSet;

});

// const optionsCategory = ['test'];

// console.log(optionsCategory2);

function setSubmitType(type) {
    submitType.value = type;
}

function setEffectiveDate(date) {
    form.effective_date = date;
}

const closeModal = () => {
    emit('close-modal');
};
</script>

<template>
    <Head title="Create Finance Record" />

        <form ref="formRef" @submit.prevent="submit">
            <div class="flex flex-row justify-around">

                <div>
                    <!-- DATE -->
                    <div>
                        <InputLabel for="date" value="Date" />
                        <TextInput
                            @change="setEffectiveDate(form.date)"
                            id="date"
                            v-model="form.date"
                            type="date"
                            class="my-3 block w-full"
                            
                            autofocus
                            autocomplete="date"
                        />
                        <InputError class="mt-2" :message="form.errors.date" />
                    </div>
        
                    <!-- NAME -->
                    <div>
                        <InputLabel for="name" value="Name" />
                        <TextInput
                            id="name"
                            v-model="form.name"
                            type="text"
                            class="my-3 block w-full"
                            
                            autofocus
                            autocomplete="name"
                        />
                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>
    
                    <!-- TYPE -->
                    <div>
                        <InputLabel for="type" value="Type" />
                        <SelectDropdown 
                            id="type"
                            v-model="form.type"
                            :options="optionsType"
                            class="my-3 block w-full"
                            
                            autofocus
                            autocomplete="type"
                        />
                        <InputError class="mt-2" :message="form.errors.type" />
                    </div>
                </div>

                <div>
                    <!-- CATEGORY -->
                    <div>
                        <InputLabel for="category_id" value="Category" />
                        <SelectDropdown 
                            id="category_id"
                            v-model="form.category_id"
                            :options="optionsCategory"
                            class="my-3 block w-full"
                            
                            autofocus
                            autocomplete="category_id"
                        />
                        <InputError class="mt-2" :message="form.errors.category_id" />
                    </div>
        
                    <!-- DESCRIPTION -->
                    <div>
                        <InputLabel for="description" value="Description" />
                        <TextInput
                            id="description"
                            v-model="form.description"
                            type="text"
                            class="my-3 block w-full"
                            
                            autofocus
                            autocomplete="description"
                        />
                        <InputError class="mt-2" :message="form.errors.description" />
                    </div>
    
                    <!-- AMOUNT -->
                    <div>
                        <InputLabel for="amount" value="Amount" />
                        <TextInput
                            id="amount"
                            v-model="form.amount"
                            type="number"
                            class="my-3 block w-full"
                            
                            autofocus
                            autocomplete="amount"
                            min="0.00" 
                            max="10000.00" 
                            step="0.01"
                        />
                        <InputError class="mt-2" :message="form.errors.amount" />
                    </div>

                    <!-- EFFECTIVE DATE -->
                    <div>
                        <InputLabel for="effective_date" value="Effective Date" />
                        <TextInput
                            id="effective_date"
                            v-model="form.effective_date"
                            type="date"
                            class="my-3 block w-full"
                            
                            autofocus
                            autocomplete="effective_date"
                        />
                        <InputError class="mt-2" :message="form.errors.effective_date" />
                    </div>
                </div>

            </div>

            <div class="flex items-center justify-end mt-4">
                <SecondaryButton @click="setSubmitType('destroy')" v-if="showRecord" :type="'submit'" class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Delete
                </SecondaryButton >
                <PrimaryButton @click="setSubmitType('update')" v-if="showRecord" class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Update
                </PrimaryButton >
                <PrimaryButton @click="setSubmitType('store')" v-if="!showRecord" class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Save
                </PrimaryButton>
            </div>
        </form>
</template>
