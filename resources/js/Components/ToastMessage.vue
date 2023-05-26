<script setup>
import { computed, watch } from "vue";
import { useToast } from "vue-toastification";

const props = defineProps({
    message: {
      type: String,
      required: false
    },
    severity: {
      type: String,
      required: false
    },
    unix: {
      type: Number,
      required: false
    }
});

console.log(props.message, props.severity, props.unix);

// Get toast interface
const toast = useToast();

// Watch for changes in message prop
watch(
  () => props.unix,
  (newValue) => {
    console.log(newValue);
    if (newValue) {
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
    }
  }, { 
    immediate: true 
  }
);

</script>