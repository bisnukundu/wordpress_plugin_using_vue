<script setup>
import { FormKit } from '@formkit/vue';
import MultiStepContent from './multi-step-content.vue';


</script>

<template>
    <FormKit type="multi-step" tab-style="progress" :allow-incomplete="false">
        <MultiStepContent />
    </FormKit>
</template>