<template lang="pug">
extends ../listTemplate.pug

block title
    span Administrators
block new_button_text
    span New Admin
block table
    table.table.table-striped.table-hover
        thead.thead-dark
            tr
                th #
                th Administrator Name
                th Email Address
        tbody
            tr(v-if='!admins')
                <td class="p-4 text-center" colspan="3">
                    | span You haven't created any administrator profiles yet.
                    | <br>
                    | span Click New Administrator button to create a profile now.
                </td>
            template(v-else)
                tr(v-for='admin in admins', :key='admin.id')
                    td {{ admin.id }}
                    td {{ admin.name }}
                    td {{ admin.email }}
</template>

<script>
import { DataFetcher } from '@rheas/vuer';

export default {
    name: 'AdminsTable',
    mounted: function () {
        this.df.fetchData(null, this.onSuccess);
    },
    data: function () {
        return {
            admins: [],
            df: new DataFetcher('/api/admin/administrators'),
        };
    },
    methods: {
        onSuccess: function (data) {
            this.admins = data;
        },
    },
};
</script>