<script setup>
import { ref } from 'vue';
import { Head, Link, router, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { NColorPicker } from 'naive-ui';

const props = defineProps({
    record: {
        type: Object,
        default: {},
    }
});

const emit = defineEmits(['closeModal']);

let showRecord = JSON.stringify(props.record) !== "{}";

let formRef = ref(null);

let submitType = ref(null);

const form = useForm({
    name: props.record['name'] ?? '',
    description: props.record['description'] ?? '',
    color: props.record['color'] ?? '#6875F5',
},{
        initialFormValues: formRef,
});

const submit = () => {

    switch (submitType.value) {
        case 'update':
            form.patch(route('category' + '.' + submitType.value, props.record), {
                preserveScroll: true,
            });
            break;
        case 'destroy':
            
            form.delete(route('category' + '.' + submitType.value, props.record), {
                preserveScroll: true,
                onSuccess: () => {
                    closeModal();
                    form.reset();
                },
            });
            break;
            
        default:
            form.post(route('category' + '.' + submitType.value), {
                preserveScroll: true,
                onSuccess: () => {
                    form.reset();
                },
            });
            break;
    }
};

console.log(props.record);

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
    <Head title="Create Finance Category Record" />

        <form ref="formRef" @submit.prevent="submit">
            <div class="flex flex-row justify-around">

                <!-- NAME -->
                <div>
                    <InputLabel for="name" value="Name" />
                    <TextInput
                        id="name"
                        v-model="form.name"
                        type="text"
                        class="my-3 block w-80"
                        
                        autofocus
                        autocomplete="name"
                    />
                    <InputError class="mt-2" :message="form.errors.name" />
                </div>

                <!-- DESCRIPTION -->
                <div>
                    <InputLabel for="description" value="Description" />
                    <TextInput
                        id="description"
                        v-model="form.description"
                        type="text"
                        class="my-3 block w-80"
                        
                        autofocus
                        autocomplete="description"
                    />
                    <InputError class="mt-2" :message="form.errors.description" />
                </div>

                <!-- COLOR -->
                <div>
                    <InputLabel for="color" value="Color" />
                    <n-color-picker
                        class="my-3 block w-80"
                        autocomplete="color"
                        id="color"
                        v-model:value="form.color"
                        :modes="['hex']"
                        :swatches="[
                            '#FFFFFF',
                            '#18A058',
                            '#2080F0',
                            '#F0A020',
                            'rgba(208, 48, 80, 1)'
                        ]"
                    />
                    <InputError class="mt-2" :message="form.errors.color" />
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
