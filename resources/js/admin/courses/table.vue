<template lang="pug">
.container-fluid
    .col-sm-12
        .title.text-left.d-inline-block Courses
        .pull-right.d-inline-block.theme-btn.all-btn(@click='$emit("toggle", true)') New Course
    .col-sm-12.pt-4.data-list
        loading-component(v-if='df.fetching')
        table.table.table-striped.table-hover(v-else)
            thead.thead-dark
                tr
                    th #
                    th Course title
                    th Status
                    th Start date
            tbody
                tr(v-if='!hasCourses')
                    td.p-4.text-center(colspan='4')
                        | You haven't created any courses yet.
                        | <br/>
                        | Click <strong>New Course</strong> button to create one now.
                template(v-else)
                    tr(
                        v-for='course in courses',
                        :key='course.id',
                        @click='$emit("toggle", true, course.id)'
                    )
                        td {{ course.id }}
                        td {{ course.title }}
                        td {{ capitalize(course.status) }}
                        td {{ course.start }}
</template>

<script>
import { DataFetcher } from '@rheas/vuer';
import LoadingComponent from '@components/loading';

export default {
    name: 'CourseTable',
    mounted: function () {
        this.df.fetchData(null, this.onSuccess);
    },
    data: function () {
        return {
            courses: [],
            df: new DataFetcher('/api/admin/courses'),
        };
    },
    methods: {
        onSuccess: function (data) {
            this.courses = data.data;
        },
        capitalize: function (string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        },
    },
    computed: {
        hasCourses: function () {
            return this.courses && this.courses.length > 0;
        },
    },
    components: { LoadingComponent },
};
</script>