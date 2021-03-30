<template lang="pug">
.section.single-section
    course-table(v-if='!edit', @toggle='toggleScreen')
    course-editor(v-else, @toggle='toggleScreen', :id='id')
</template>

<script>
import CourseTable from './table';
import CourseEditor from './editor';
import editable from '@mixins/editable';

export default {
    name: 'CourseHandler',
    mixins: [editable],
    components: { CourseEditor, CourseTable },
};
</script>