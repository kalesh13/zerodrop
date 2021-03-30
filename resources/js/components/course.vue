<template lang="pug">
a(:href='course.url')
    img.course-img.curved-img(:src='courseImage', :alt='course.title')
    .course-title(v-text='course.title')
    .course-desc(v-html='course.snippet')
    .batch-details
        span.text-left NEXT BATCH
        span.float-right.value(v-text='course.start')
    .batch-details
        span.text-left DURATION
        span.float-right.value(v-text='course.durationText')
</template>

<script>
export default {
    props: {
        course: Object,
    },
    computed: {
        courseImage: function () {
            return this.course.course_image || '/images/featured_course.jpg';
        },
    },
};
</script>
