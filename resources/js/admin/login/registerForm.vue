<template lang="pug">
form.form-horizontal(method='POST', @submit.prevent='onSubmit')
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
    .form-group.mt-4
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
                    client_id: '65xrzfy4g8aLWNMB1z3kVji7gooMWu',
                },
                (data) => {
                    this.$store.commit('user/setProfileData', data);

                    window.location.href = data.redirectTo || '/admin/';
                },
                (errors) => {
                    let error = this.dp.errors.email || this.dp.errors.password;

                    if (this.dp.errors.server_error) {
                        error = ['Server error. Please try again later.'];
                    }
                    return (this.dp.errors = { password: error });
                },
            );
        },
    },
    components: { CustomInput },
};
</script>