<script setup>
import { ref, reactive, nextTick, computed } from 'vue';
import DialogModal from './DialogModal.vue';
import InputError from './InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from './TextInput.vue';
import RecordCreateForm from '@/Components/FinanceRecordCreateForm.vue';

const emit = defineEmits(['confirmed']);

const props = defineProps({
    title: {
        type: String,
        default: 'Finance Record',
    },
    record: {
        type: Object,
        default: {},
    },
});

const record = computed(() => {
    if (props.record) {
        return props.record;
    }
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
            </template>

            <template #content>
                <RecordCreateForm :record="record"/>
            </template>

            <template #footer>
                    <SecondaryButton @click="closeModal">
                        Cancel
                    </SecondaryButton>
    
                    <PrimaryButton
                        class="ml-3"
                        @click="storeRecord"
                    >
                        Save
                    </PrimaryButton>
            </template>
        </DialogModal>
    </span>
</template>
