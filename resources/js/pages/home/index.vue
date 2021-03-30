<template lang="pug">
section.router
    featured(:id='pageData.feature_course')
    courses(:description='pageData.course_description')
    contact(:description='pageData.contact_description', :phone='pageData.contact_phone')
        slot
</template>

<script>
import Courses from './courses';
import Contact from './contact';
import Featured from './featuredCourse';

export default {
    name: 'home',
    props: ['pageData'],
    components: { Featured, Courses, Contact },
};
</script>