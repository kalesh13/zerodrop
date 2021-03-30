<template lang="pug">
.form-group
    label.login-label(v-text='label')
    .row.duration
        select.form-control.col-sm-4(
            v-bind='$attrs',
            v-model='selected_duration',
            :class='{ "is-invalid": error }',
            :value='value',
            @change='$emit("input", selected_duration)'
        )
            option(
                v-for='(value, key) in availableOptions',
                :key='key',
                :value='key',
                v-text='value'
            )
        select.form-control.col-sm-4(
            name='time',
            :value='selected_period',
            @change='onPeriodUpdated($event.target.value)'
        )
            option(value='0') Days
            option(value='1') Months
    .small-text-danger.mt-2(v-if='error', v-text='error[0]')
</template>

<script>
export default {
    name: 'Duration',
    inheritAttrs: false,
    props: ['label', 'error', 'value'],
    mounted: function () {
        if (this.value == null) {
            return;
        }
        this.selected_duration = this.value;
        this.selected_period = this.value > 31 ? 1 : 0;
    },
    data: function () {
        return {
            selected_period: 0,
            selected_duration: 1,
        };
    },
    methods: {
        onPeriodUpdated: function (value) {
            this.select_duration = '';
            this.selected_period = value;
        },
    },
    computed: {
        availableOptions: function () {
            let options = {};
            let start_option = this.selected_period == 0 ? 1 : 32;
            let end_option = this.selected_period == 0 ? 31 : 12;

            for (let option = 0; option < end_option; option++) {
                options[option + start_option] = option + 1;
            }
            return options;
        },
    },
};
</script>

<style scoped>
.row.duration {
    margin-left: 0px;
    margin-right: 0px;
}
.row.duration select {
    margin-bottom: 1rem;
    margin-right: 0px;
}
.row.duration select:last-child {
    margin-right: 0px;
    margin-bottom: 0px;
}

@media (min-width: 576px) {
    .row.duration select {
        margin-right: 10px;
        margin-bottom: 0px;
    }
}
</style>