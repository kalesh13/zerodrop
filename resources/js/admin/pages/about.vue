<template lang="pug">
extends template.pug
block page_title
    span About Page
block page_form
    .course-form
        .form-group
            label.login-label Description
            custom-editor(v-model='form_data.description', :error='pu.errors.description')
        custom-select(
            v-model='form_data.show_team',
            :error='pu.errors.show_team',
            :options='team_options',
            label='Show members',
            name='show_team',
            required
        )
        custom-select(
            v-model='form_data.team_member_1',
            :error='pu.errors.team_member_1',
            :options='team_members',
            label='Team member 1',
            name='team_member_1',
            required
        )
        custom-select(
            v-model='form_data.team_member_2',
            :error='pu.errors.team_member_2',
            :options='team_members',
            label='Team member 2',
            name='team_member_2',
            required
        )
        custom-select(
            v-model='form_data.team_member_3',
            :error='pu.errors.team_member_3',
            :options='team_members',
            label='Team member 3',
            name='team_member_3',
            required
        )
        custom-select(
            v-model='form_data.team_member_4',
            :error='pu.errors.team_member_4',
            :options='team_members',
            label='Team member 4',
            name='team_member_4',
            required
        )
        seo-fields(:fields='form_data')
</template>

<script>
import { DataFetcher } from '@rheas/vuer';
import { PageUpdater } from './PageUpdater';
import SeoFields from '@components/seoWidget';
import CustomEditor from '@components/editor';
import LoadingComponent from '@components/loading';
import UpdateWidget from '@components/updateWidget';
import CustomSelect from '@components/formGroupSelect';

export default {
    name: 'About',
    mounted: function () {
        new DataFetcher().fetchData('/api/teams', this.onTeamMembersFetched);

        this.df.fetchData(null, (data) => (this.form_data = data));
    },
    data: function () {
        return {
            form_data: {
                description: '',
                show_team: '',
                team_member_1: '',
                team_member_2: '',
                team_member_3: '',
                team_member_4: '',
                meta_title: '',
                meta_keywords: '',
                meta_description: '',
            },
            team_members: {},
            pu: new PageUpdater(),
            df: new DataFetcher('/api/page/about'),
        };
    },
    methods: {
        onTeamMembersFetched: function (data) {
            (data || []).foreach((member) => {
                this.team_members[member.id] = member.name;
            });
        },
        onSubmit: function () {
            this.pu.updatePage('/api/admin/page/about', this.form_data);
        },
    },
    components: { LoadingComponent, UpdateWidget, SeoFields, CustomEditor, CustomSelect },
};
</script>