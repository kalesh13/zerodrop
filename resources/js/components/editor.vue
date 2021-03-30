<template lang="pug">
<div>
    .custom-editor(:class='{ "is-invalid": error }')
        vue-editor(v-model='content', :editorToolbar='customToolbar')
    .small.text-danger.mt-2(v-if='error', v-text='error[0]')
</div>
</template>

<script>
import { VueEditor } from 'vue2-editor';

export default {
    name: 'Editor',
    props: ['value', 'error'],
    mounted: function () {
        this.content = this.value;
    },
    watch: {
        value: function (new_value) {
            this.content = new_value;
        },
        content: function (new_value) {
            this.$emit('input', new_value);
        },
    },
    data: function () {
        return {
            customToolbar: [
                [{ header: [false, 1, 2, 3, 4, 5, 6] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ list: 'ordered' }, { list: 'bullet' }],
                [{ align: '' }, { align: 'center' }, { align: 'right' }, { align: 'justify' }],
                ['link', 'blockquote', 'code-block'],
                ['clean'],
            ],
            content: '',
        };
    },
    components: { VueEditor },
};
</script>