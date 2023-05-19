<script setup>
import { ref } from 'vue';
import { Head, Link, router, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Dropdown from '@/Components/Dropdown.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import SelectDropdown from '@/Components/SelectDropdown.vue';

const props = defineProps({
    record: {
        type: Object,
        default: {},
    },
});

let formRef = ref(null);

const form = useForm({
    date: props.record['date'] ? (props.record['date'].split(" "))[0] : '',
    name: props.record['name'] ?? '',
    type: props.record['type'] ?? '',
    category: props.record['category'] ?? '',
    description: props.record['description'] ?? '',
    amount: props.record['amount'] ? props.record['amount'].toString() : '',
    effective_date: props.record['effective_date'] ? (props.record['effective_date'].split(" "))[0] : '',
},{
        initialFormValues: formRef,
});

const submit = () => {
  form.post(route('finance.store'), {
    preserveScroll: true,
    onSuccess: () => {
      form.reset();
    },
  });
};
// router.post(route('finance.store'), form);

const optionsType = ['Income', 'Expense', 'Saving'];
const optionsCategory = ['Testing'];

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
                        <InputLabel for="category" value="Category" />
                        <SelectDropdown 
                            id="category"
                            v-model="form.category"
                            :options="optionsCategory"
                            class="my-3 block w-full"
                            
                            autofocus
                            autocomplete="category"
                        />
                        <InputError class="mt-2" :message="form.errors.category" />
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
                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Save
                </PrimaryButton>
            </div>
        </form>
</template>
