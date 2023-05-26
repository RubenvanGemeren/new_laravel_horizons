<script setup>
import { ref, reactive, nextTick, computed } from 'vue';
import DialogModal from './DialogModal.vue';
import InputError from './InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from './TextInput.vue';
import CategoryCreateForm from '@/Components/FinanceCategoryCreateForm.vue';

const props = defineProps({
    title: {
        type: String,
        default: 'Finance Record',
    },
    record: {
        type: Object,
        default: {},
    },
    categories: {
        type: Array,
        required: true,
    }
});

const record = computed(() => {
    if (props.record) {
        return props.record;
    }
});

const categories = computed(() => {
    return props.categories;
});

console.log(record);

const storeRecord = () => {
    form.processing = true;
    
    // Store record
    console.log('STORING THE DATA');
};

const showFianceRecord = ref(false);

const closeModal = () => {
    console.log("CLOSING MODAL");
    showFianceRecord.value = false;
};

const startShowFianceRecord = () => {
    console.log("OPENING MODAL");
    showFianceRecord.value = true;
}
</script>
<template>
    <span>
        <span @click="startShowFianceRecord">
            <slot />
        </span>

        <DialogModal :maxWidth="'5xl'" :show="showFianceRecord" @close="closeModal">
            <template #title>
                <p>Record:  "{{ title }}"</p>
                <SecondaryButton @click="closeModal">
                        Cancel
                </SecondaryButton>
            </template>

            <template #content>
                <CategoryCreateForm @close-modal="closeModal" :record="record" :categories="categories" />    
            </template>
        </DialogModal>
    </span>

</template>
