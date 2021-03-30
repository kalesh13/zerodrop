<template lang="pug">
.section.courses
    .title Courses
    .desc(v-if='description', v-text='description')
    .container.content.px-0
        .courses.text-center.mx-auto.d-table
            .course.text-left(v-for='course in courses', :key='course.id')
                course-card(:course='course')
        .text-center
            a(href='/courses')
                .theme-btn.all-btn View all
</template>

<script>
import { DataFetcher } from '@rheas/vuer';
import CourseCard from '@components/course';

export default {
    name: 'CoursesInHome',
    props: ['description'],
    mounted: function () {
        this.df.fetchData(null, this.onSuccess);
    },
    data: function () {
        return {
            courses: [],
            df: new DataFetcher('/api/courses?limit=4&active=1'),
        };
    },
    methods: {
        onSuccess: function (data) {
            this.courses = data.data;
        },
    },
    components: { CourseCard },
};
</script>