<template lang="pug">
.section.contact
    .title Contact us
    .desc(v-if='description', v-text='description')
    .container.content
        .row
            .col-md-6
                slot
                .text-center.mt-5
                    template(v-if='phone')
                        .call Or, Call us at
                        .phone
                            span.fa.fa-phone
                            span(v-text='phone')
            .col-md-6.desktop-only
                template(v-if='contact && contact.map')
                    div(v-html='contact.map')
</template>

<script>
import { DataFetcher } from '@rheas/vuer';

export default {
    name: 'ContactInHome',
    props: ['description', 'phone'],
    mounted: function () {
        this.df.fetchData(null, this.onSuccess);
    },
    data: function () {
        return {
            contact: null,
            df: new DataFetcher('/api/page/contact'),
        };
    },
    methods: {
        onSuccess: function (data) {
            this.contact = data;
        },
    },
};
</script>