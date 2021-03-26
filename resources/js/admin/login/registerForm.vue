<template lang="pug">
.form-horizontal(method='POST', @submit.prevent='onSubmit')
    custom-input(v-model='email', label='Email Address', name='email', type='email', required)
    custom-input(v-model='password', label='Password', name='password', type='password', required)
    custom-input(
        v-model='password_confirmation',
        label='Password Confirmation',
        name='password_confirmation',
        type='password',
        :error='dp.errors.password',
        required
    )
    .form-group
        button.btn.theme-btn(type='submit', :disabled='dp.submitted')
            span.fa.fa-circle-o-notch.fa-spin.mr-2(v-if='dp.submitted')
            | Register
</template>

<script>
import { DataPoster } from '@rheas/vuer';
import CustomInput from '@components/formGroupInput';

export default {
    name: 'registerForm',
    data: function () {
        return {
            email: '',
            password: '',
            password_confirmation: '',
            dp: new DataPoster(),
        };
    },
    methods: {
        onSubmit: function () {
            this.dp.formPost(
                '/api/admin/register',
                {
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirmation,
                    client_id: '8VVzvJBHInjfxzsmPojPnxPunmYVbk',
                },
                (data) => {
                    this.$store.commit('user/setProfileData', data);
                    window.location.href = data.redirect_to || '/admin/';
                },
                (errors) => (this.dp.errors = { password: [errors.server_response] }),
            );
        },
    },
    components: { CustomInput },
};
</script>