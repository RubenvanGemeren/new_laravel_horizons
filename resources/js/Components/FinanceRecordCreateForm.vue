<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Dropdown from '@/Components/Dropdown.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import SelectDropdown from '@/Components/SelectDropdown.vue';

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};

const optionsType = ['Income', 'Expense', 'Saving'];
const optionsCategory = ['Testing'];

</script>

<template>
    <Head title="Create Finance Record" />


        <form @submit.prevent="submit">
            <div class="flex flex-row justify-between">
                <!-- DATE -->
                <div>
                    <InputLabel for="date" value="Date" />
                    <TextInput
                        id="date"
                        v-model="form.date"
                        type="date"
                        class="mt-1 block w-full"
                        required
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
                        class="mt-1 block w-full"
                        required
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
                        v-model="optionsType"
                        class="mt-1 block w-full"
                        required
                        autofocus
                        autocomplete="type"
                    />
                    <InputError class="mt-2" :message="form.errors.type" />
                </div>

                <!-- CATEGORY -->
                <div>
                    <InputLabel for="category" value="Category" />
                    <SelectDropdown 
                        id="category"
                        v-model="optionsCategory"
                        class="mt-1 block w-full"
                        required
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
                        class="mt-1 block w-full"
                        required
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
                        class="mt-1 block w-full"
                        required
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
                    <InputLabel for="effectiveDate" value="Effective Date" />
                    <TextInput
                        id="effective-date"
                        v-model="form.effectiveDate"
                        type="date"
                        class="mt-1 block w-full"
                        required
                        autofocus
                        autocomplete="effective-date"
                    />
                    <InputError class="mt-2" :message="form.errors.effectiveDate" />
                </div>

            </div>

            <div class="flex items-center justify-end mt-4">
                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Save
                </PrimaryButton>    
            </div>
        </form>
</template>
