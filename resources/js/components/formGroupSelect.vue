<template lang="pug">
extends formGroup.pug
block input
    select.form-control(
        :class='{ "is-invalid": error }',
        v-bind='$attrs',
        :value='value',
        @change='$emit("input", $event.target.value)'
    )
        option(
            v-for='(value, key) in options',
            :key='key',
            :value='key',
            :selected='key === value',
            v-text='value'
        )
</template>

<script>
export default {
    inheritAttrs: false,
    name: 'formGroupSelect',
    props: ['label', 'error', 'value', 'options'],
};
</script>
