<template lang="pug">
.section.single-section
    .col-md-4.mx-auto
        .text-center.login-title Administrator Login
        .login-box
            transition(name='slide-fade')
                login-form(v-if='isLogin', @toggle_screen='isLogin = !isLogin')
            reset-form(v-if='!isLogin', :is-login-form='true', @toggle_screen='isLogin = !isLogin')
</template>

<script>
import { mapMutations } from 'vuex';
import LoginForm from './loginForm';
import ResetForm from './resetForm';

export default {
    name: 'Login',
    mounted: function () {
        this.logout();
    },
    data: function () {
        return {
            isLogin: true,
        };
    },
    methods: {
        ...mapMutations('user', ['logout']),
    },
    components: { LoginForm, ResetForm },
};
</script>

<style scoped>
.slide-fade-enter-active {
    transition: all 0.3s ease;
}

.slide-fade-leave-active {
    transition: all 0.1s ease;
}

.slide-fade-enter,
.slide-fade-leave-to {
    transform: translateY(-10px);
    opacity: 0;
}
</style>
