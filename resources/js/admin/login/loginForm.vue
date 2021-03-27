<template lang="pug">
form.form-horizontal(method='POST', @submit.prevent='onSubmit')
    custom-input(
        v-model='email',
        label='Email address',
        name='email',
        type='email',
        placeholder='yuri@example.com',
        required
    )
    custom-input(
        v-model='password',
        label='Password',
        name='password',
        type='password',
        placeholder='Account password',
        :error='dp.errors.password',
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
                '/api/admin/login',
                {
                    email: this.email,
                    password: this.password,
                    client_id: '65xrzfy4g8aLWNMB1z3kVji7gooMWu',
                },
                this.onSuccess,
                this.onError,
            );
        },
        onSuccess: function (data) {
            this.$store.commit('user/setProfileData', data);

            window.location.href = this.$route.query.redirectTo || '/admin';
        },
        onError: function () {
            let error = ['Invalid email address and/or password.'];

            if (this.dp.errors.server_error) {
                error = ['Server error. Please try again later.'];
            }
            return (this.dp.errors.password = error);
        },
    },
    components: { CustomInput },
};
</script>