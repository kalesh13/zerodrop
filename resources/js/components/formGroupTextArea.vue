<template lang="pug">
extends formGroup.pug
block input
    textarea.form-control(
        :class='{ "is-invalid": error }',
        v-bind='$attrs',
        :value='value',
        @input='$emit("input", $event.target.value)'
    )
</template>

<script>
export default {
    inheritAttrs: false,
    name: 'formGroupTextArea',
    props: ['label', 'error', 'value'],
};
</script>