<template lang="pug">
.container-fluid
    .col-sm-12
        .title.text-left.d-inline-block(v-text='pageTitle')
        .pull-right.d-inline-block.theme-btn.all-btn(@click='$emit("toggle", false)') Back
    .col-sm-12.pt-4
        loading-component(v-if='df.fetching') 
        .row(v-else)
            form.form-horizontal.col-md-7.course-form(method='POST', @submit.prevent)
                uploader(
                    v-model='form_data.image',
                    label='Profile image',
                    name='image',
                    :error='dp.errors.image'
                )
            update-widget(@publish='onSubmit', @cancel='$emit("cancel")', :update='form_data.id')
</template>

<script>
import Uploader from '@components/uploader';
import LoadingComponent from '@components/loading';
import UpdateWidget from '@components/updateWidget';
import { DataFetcher, DataPoster } from '@rheas/vuer';

export default {
    name: 'TeamMemberEditor',
    props: ['id'],
    mounted: function () {
        if (this.id == null) {
            return;
        }
        this.df.fetchData(null, (data) => (this.form_data = data));
    },
    data: function () {
        return {
            form_data: {},
            dp: new DataPoster(),
            df: new DataFetcher(`/api/admin/team/${this.id}`),
        };
    },
    methods: {
        onSubmit: function () {
            this.dp.formPost(`/api/admin/team/${this.id}`, this.form_data);
        },
    },
    computed: {
        pageTitle: function () {
            return this.form_data.id ? 'Edit Profile' : 'New Member';
        },
    },
    components: { LoadingComponent, Uploader, UpdateWidget },
};
</script>