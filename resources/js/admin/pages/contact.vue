<template lang="pug">
extends template.pug
block page_title
    span Contact Page
block page_form
    .course-form
        custom-text(
            v-model='form_data.description',
            :error='pu.errors.description',
            label='Description',
            name='description',
            required
        )
        custom-input(
            v-model='form_data.map',
            :error='pu.errors.map',
            label='Map embed code',
            name='map',
            required
        )
        seo-fields(:fields='form_data')
</template>

<script>
import { DataFetcher } from '@rheas/vuer';
import { PageUpdater } from './PageUpdater';
import SeoFields from '@components/seoWidget';
import LoadingComponent from '@components/loading';
import UpdateWidget from '@components/updateWidget';
import CustomInput from '@components/formGroupInput';
import CustomText from '@components/formGroupTextArea';

export default {
    name: 'Contact',
    mounted: function () {
        this.df.fetchData(null, (data) => (this.form_data = data));
    },
    data: function () {
        return {
            form_data: {
                description: '',
                map: '',
                meta_title: '',
                meta_description: '',
                meta_keywords: '',
            },
            pu: new PageUpdater(),
            df: new DataFetcher('/api/page/contact'),
        };
    },
    methods: {
        onSubmit: function () {
            this.pu.updatePage('/api/admin/page/contact', this.form_data);
        },
    },
    components: { CustomInput, CustomText, LoadingComponent, UpdateWidget, SeoFields },
};
</script>