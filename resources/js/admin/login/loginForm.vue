<template lang="pug">
form.form-horizontal(method='POST', @submit.prevent='onSubmit')
    custom-input(v-model='email', label='Email address', name='email', type='email', required)
    custom-input(
        v-model='password',
        label='Password',
        name='password',
        type='password',
        :error='dp.errors',
        required
    )
    .form-group
        a.float-right(href='#', @click.prevent='$emit("toggle_screen")')
            | Forgot Password
    .form-group
        button.btn.theme-btn(type='submit', :disabled='dp.submitted')
            span.fa.fa-circle-o-notch.fa-spin.mr-2(v-if='dp.submitted')
            | Login
</template>

<script>
import { DataPoster } from '@rheas/vuer';
import CustomInput from '@components/formGroupInput';

export default {
    name: 'loginForm',
    data: function () {
        return {
            email: '',
            password: '',
            dp: new DataPoster(),
        };
    },
    methods: {
        onSubmit: function () {
            this.dp.formPost(
                '/api/login',
                {
                    email: this.email,
                    password: this.password,
                    client_id: '8VVzvJBHInjfxzsmPojPnxPunmYVbk',
                },
                this.onSuccess,
                this.onError,
            );
        },
        onSuccess: function (data) {
            this.$store.commit('user/setProfileData', data);

            window.location.href = this.$route.query.redirect_to || '/admin';
        },
        onError: function () {
            if (this.dp.errors.server_error) {
                return (this.dp.errors = ['Server error. Please try again later.']);
            }
            return (this.dp.errors = ['Invalid email address and/or password.']);
        },
    },
    components: { CustomInput },
};
</script>