<template lang="pug">
.col-md-5
    .update-box.clearfix
        .title.text-left Actions
        slot 
        .d-flex
            .my-auto.mr-4.ml-auto
                ul
                    li
                        a(href='/', @click.prevent='$emit("cancel")') Cancel
            .theme-btn.all-btn(:class='{ disabled: submitted }', @click='$emit("publish")')
                span.fa.fa-circle-o-notch.fa-spin(v-if='submitted')
                | {{ update ? "Update" : "Publish" }}
        .small.mt-2(v-if='!submitted && serverResponse', :class='responseStatusClass')
            | {{ serverResponse }}
</template>

<script>
export default {
    name: 'UpdateWidget',
    props: ['update', 'submitted', 'status'],
    computed: {
        responseStatusClass: function () {
            if (!this.status) {
                return '';
            }
            return this.status.error ? 'text-danger' : 'text-success';
        },
        serverResponse: function () {
            return this.status && this.status.message;
        },
    },
};
</script>

<style scoped>
.update-box {
    width: 100%;
    padding: 15px;
    background-color: #efefef;
}

.update-box .title {
    text-align: left;
    font-size: 1.1rem;
    border-bottom: 1px dashed rgba(0, 0, 0, 0.2);
}

.update-box ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.update-box ul li {
    display: inline-block;
}

.update-box .theme-btn.disabled {
    cursor: not-allowed;
}
</style>