<template lang="pug">
form.form-horizontal(method='POST', @submit.prevent='onSubmit')
    .form-group.back-arrow(v-if='isLoginForm')
        a(href='#', @click.prevent='$emit("toggle_screen")')
            span.fa.fa-arrow-circle-left.float-left
    .form-group
        label.login-label Email Address
        input.form-control(v-model='email', name='email', required)
    .p-2(
        v-if='message',
        :class='message.success ? "alert-success" : "alert-danger"',
        v-text='message.message'
    )
    .form-group
        button.btn.theme-btn.mt-4(type='submit', :disabled='dp.submitted')
            span.fa.fa-circle-o-notch.fa-spin.mr-2(v-if='dp.submitted')
            | Reset Password
</template>

<script>
import { DataPoster } from '@rheas/vuer';

export default {
    name: 'resetForm',
    props: {
        isLoginForm: {
            default: false,
            type: Boolean,
        },
    },
    data: function () {
        return {
            email: '',
            messge: null,
            dp: new DataPoster(),
        };
    },
    methods: {
        onSubmit: function () {
            this.message = null;

            this.dp.formPost(
                '/api/password/email',
                { email: this.email },
                this.onSuccess,
                this.onFailure,
            );
        },
        onSuccess: function () {
            this.message = {
                success: true,
                message: 'An email with password reset instruction has been sent to ' + this.email,
            };
        },
        onFailure: function () {
            this.message = {
                success: false,
                message: 'Error sending password reset email. Contact administrator.',
            };
        },
    },
};
</script>