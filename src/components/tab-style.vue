<script setup>
import { FormKit } from '@formkit/vue';
import MultiStepContent from './multi-step-content.vue';


</script>

<template>
    <FormKit type="multi-step" tab-style="progress">
    <MultiStepContent />
</FormKit>
</template>