<template lang="pug">
.courses.text-center.mx-auto.d-table
    .course.text-left(v-for='course in courses', :key='course.id')
        course-card(:course='course')
</template>

<script>
import CourseCard from '@components/course';
import { DataFetcher } from '@rheas/vuer';

export default {
    name: 'coursesOnHome',
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
            this.courses = data;
        },
    },
    components: { CourseCard },
};
</script>