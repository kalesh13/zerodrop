<template lang="pug">
.container-fluid
    .col-sm-12
        .title.text-left.d-inline-block(v-text='id ? "Edit Course" : "New Course"')
        .pull-right.d-inline-block.theme-btn.all-btn(@click='$emit("toggle", false)') Back
    .col-sm-12.pt-4
        loading-component(v-if='df.fetching')
        course-form(v-else, @cancel='$emit("toggle", false)', :course='course')
</template>

<script>
import CourseForm from './form';
import { DataFetcher } from '@rheas/vuer';
import LoadingComponent from '@components/loading';

export default {
    name: 'CourseEditor',
    props: ['id'],
    mounted: function () {
        if (this.id == null) {
            return;
        }
        this.df.fetchData(null, this.onFetchSuccess);
    },
    data: function () {
        return {
            course: {},
            df: new DataFetcher(`/api/course/${this.id}`),
        };
    },
    methods: {
        onFetchSuccess: function (data) {
            this.course = data;
        },
    },
    components: { LoadingComponent, CourseForm },
};
</script>