<script setup>
import { useToast } from "vue-toastification";
// Import the CSS or use your own!
import "vue-toastification/dist/index.css";

defineProps({
    value: String,
    type: String,
});

// Get toast interface
const toast = useToast();

// or with options
toast.success("My toast content", {
        timeout: 2000
      });


</script>

<template>
</template>