<template lang="pug">
div(v-if='!course')
.section.featured(v-else)
    .container.content
        .row
            .col-md-6
                .title.text-left(v-text='course.title')
                .featured-content
                    .desc.container.px-0
                        .desc.text-left(v-html='course.description')
                    .actions.mt-4
                        a(:href='course.url')
                            .theme-btn.reverse.all-btn Details
            .col-md-6
                img.curved-img(
                    :src='course.course_image || "/images/featured_course.jpg"',
                    :alt='course.title'
                )
</template>

<script>
import { DataFetcher } from '@rheas/vuer';

export default {
    name: 'FeaturedInHome',
    props: ['id'],
    mounted: function () {
        this.df.fetchData(null, this.onSuccess);
    },
    data: function () {
        return {
            course: null,
            df: new DataFetcher(`/api/course/${this.id}`),
        };
    },
    methods: {
        onSuccess: function (data) {
            this.course = data;
        },
    },
};
</script>