<template lang="pug">
extends formGroup.pug
block input
    input.form-control(
        :class='{ "is-invalid": error }',
        v-bind='$attrs',
        :value='value',
        @input='$emit("input", $event.target.value)'
    )
</template>

<script>
export default {
    inheritAttrs: false,
    name: 'formGroupInput',
    props: ['label', 'error', 'value'],
};
</script>