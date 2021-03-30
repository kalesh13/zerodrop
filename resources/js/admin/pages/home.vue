<template lang="pug">
extends template.pug
block page_title
    span Home Page
block page_form
    .course-form
        uploader(
            v-model='form_data.feature_image',
            :error='pu.errors.feature_image',
            label='Carousal Image',
            name='feature_image'
        )
        custom-input(
            v-model='form_data.carousal_text',
            :error='pu.errors.carousal_text',
            label='Carousal Image Text',
            name='carousal_text',
            required
        )
        custom-select(
            v-model='form_data.feature_course',
            :error='pu.errors.feature_course',
            :options='courses',
            label='Featured course',
            name='feature_course',
            required
        )
        custom-text(
            v-model='form_data.course_description',
            :error='pu.errors.course_description',
            label='Course section description',
            name='course_description',
            required
        )
        custom-text(
            v-model='form_data.contact_description',
            :error='pu.errors.contact_description',
            label='Contact section description',
            name='contact_description',
            required
        )
        custom-select(
            v-model='form_data.contact_phone',
            :error='pu.errors.contact_phone',
            :options='phone_numbers',
            label='Contact phone',
            name='contact_phone',
            required
        )
        seo-fields(:fields='form_data')
</template>

<script>
import { DataFetcher } from '@rheas/vuer';
import { PageUpdater } from './PageUpdater';
import Uploader from '@components/uploader';
import SeoFields from '@components/seoWidget';
import LoadingComponent from '@components/loading';
import UpdateWidget from '@components/updateWidget';
import CustomInput from '@components/formGroupInput';
import CustomSelect from '@components/formGroupSelect';
import CustomText from '@components/formGroupTextArea';

export default {
    name: 'Home',
    mounted: function () {
        new DataFetcher().fetchData('/api/courses?filter=active', this.onCoursesFetched);
        new DataFetcher().fetchData('/api/page/settings', this.onSettingsFetched);

        this.df.fetchData(null, (data) => (this.form_data = data));
    },
    data: function () {
        return {
            form_data: {
                feature_image: '',
                carousal_text: '',
                feature_course: '',
                course_description: '',
                contact_description: '',
                contact_phone: '',
                meta_title: '',
                meta_description: '',
                meta_keywords: '',
            },
            courses: {},
            phone_numbers: {},
            pu: new PageUpdater(),
            df: new DataFetcher('/api/page/home'),
        };
    },
    methods: {
        onCoursesFetched: function (data) {
            (data.data || []).forEach((course) => {
                this.courses[course.id] = course.title;
            });
        },
        onSettingsFetched: function ({ phone_1, phone_2 }) {
            if (phone_1) {
                this.phone_numbers = { [phone_1]: phone_1 };
            }
            if (phone_2) {
                this.phone_numbers = { ...this.phone_numbers, [phone_2]: phone_2 };
            }
        },
        onSubmit: function () {
            this.pu.updatePage('/api/admin/page/home', this.form_data);
        },
    },
    components: {
        SeoFields,
        LoadingComponent,
        UpdateWidget,
        CustomInput,
        CustomSelect,
        CustomText,
        Uploader,
    },
};
</script>