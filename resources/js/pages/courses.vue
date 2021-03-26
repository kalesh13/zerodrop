<template lang="pug">
.all-courses
    .courses-action.col-md-12
        .row
            .title All Courses
            .ml-auto.mb-3
                .dropdown
                    #sort-btn.btn.sort.pull-right.dropdown-toggle(
                        data-toggle='dropdown',
                        aria-haspopup='true',
                        aria-expanded='false'
                    ) Sort
                    .dropdown-menu.dropdown-menu-right(aria-labelledby='sort-btn')
                        a.dropdown-item(@click.prevent='null') Starting soon
                        a.dropdown-item(@click.prevent='null') Starting late
    .row.courses.d-table
        .course.text-left(v-for='course in courses', :key='course.id')
            course-card(:course='course')
</template>

<script>
import { DataFetcher } from '@rheas/vuer';
import CourseCard from '@components/course';

export default {
    name: 'courses',
    mounted: function () {
        this.df.fetchData(null, this.onSuccess);
    },
    data: function () {
        return {
            courses: [],
            df: new DataFetcher('/api/courses'),
        };
    },
    methods: {
        onSuccess: function (data) {
            this.courses = data;
        },
    },
    components: { CourseCard },
};
</script>