<template lang="pug">
.section.single-section
    .col-md-4.mx-auto
        .text-center.login-title Administrator Registration
        .login-box
            register-form 
</template>

<script>
import { mapMutations } from 'vuex';
import RegisterForm from './registerForm';

export default {
    name: 'RegisterComponent',
    mounted: function () {
        this.logout();
    },
    methods: {
        ...mapMutations('user', ['logout']),
    },
    components: { RegisterForm },
};
</script>