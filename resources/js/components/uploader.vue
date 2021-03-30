<template lang="pug">
.form-group
    label.login-label(v-text='label')
    .file-input
        input(v-bind='$attrs', type='file', @change='onFileChanged')
        span.fa.fa-circle-o-notch.fa-spin.ml-auto(v-if='uh.submitted')
        span.fa.fa-check.ml-auto(v-if='value && !uh.submitted')
    .mt-2(v-if='value')
        a.small(:href='value', target='_blank') Download
        .small.text-danger.mt-2(v-if='uh.errors[file_name]', v-text='uh.errors[file_name][0]')
</template>

<script>
import { UploadHandler } from '@rheas/vuer';

export default {
    name: 'Uploader',
    inheritAttrs: false,
    props: ['label', 'value', 'error'],
    data: function () {
        return {
            uh: new UploadHandler('/api/upload'),
            file_name: this.$attrs.name || 'file',
        };
    },
    methods: {
        onFileChanged: function (e) {
            this.uh.upload(e.target.files, this.file_name, this.onUploadSuccess);
        },
        onUploadSuccess: function (response) {
            this.$emit('input', response[this.file_name]);
        },
    },
    computed: {
        errors: function () {
            return this.uh.errors && this.uh.errors[this.file_name];
        },
    },
};
</script>