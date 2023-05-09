<script setup>
import { useToast } from "vue-toastification";

const props = defineProps({
    message: {
      type: String,
      required: false
    },
    severity: {
      type: String,
      required: false
    }
    
});

// Get toast interface
const toast = useToast();

// or with options
toast(props.message, {
  type: props.severity,
  position: "top-right",
  timeout: 2971,
  closeOnClick: true,
  pauseOnFocusLoss: true,
  pauseOnHover: true,
  draggable: true,
  draggablePercent: 0.6,
  showCloseButtonOnHover: true,
  hideProgressBar: false,
  closeButton: "button",
  icon: true,
  rtl: false
});

</script>

<template>
</template>