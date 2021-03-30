<template lang="pug">
extends ../listTemplate.pug

block title
    span Team
block new_button_text
    span New Member
block table
    table.table.table-striped.table-hover
        thead.thead-dark
            tr
                th #
                th Member Name
                th Designation
                th Credentials
                th Profile Image
        tbody
            tr(v-if='!members')
                td.p-4.text-center(colspan='5')
                    | span You haven't created any member profiles yet.
                    | <br>
                    | span Click New Member button to create a profile now.
            template(v-else)
                tr(
                    v-for='member in members',
                    :key='member.id',
                    @click='$emit("toggle", true, member.id)'
                )
                    td {{ member.id }}
                    td {{ member.name }}
                    td {{ member.designation }}
                    td {{ member.designation }}
                    td
                        a(v-if='member.image', :href='member.image', target='_blank')
                            span.fa.fa-external-link-alt Preview
</template>

<script>
import { DataFetcher } from '@rheas/vuer';

export default {
    name: 'TeamMembers',
    mounted: function () {
        this.df.fetchData(null, this.onSuccess);
    },
    data: function () {
        return {
            members: [],
            df: new DataFetcher('/api/admin/team'),
        };
    },
    methods: {
        onSuccess: function (data) {
            this.members = data;
        },
    },
};
</script>