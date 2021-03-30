<template lang="pug">
.row
    form.form-horizontal.col-md-7.course-form(method='POST', @submit.prevent)
        custom-input(
            v-model='form_data.title',
            name='title',
            label='Course Title',
            :error='dp.errors.title',
            required
        )
        custom-input(
            v-model='form_data.snippet',
            name='snippet',
            label='Short Description (Max 160 characters)',
            :error='dp.errors.snippet'
        )
        .form-group
            label.login-label Course description
            custom-editor(v-model='form_data.description', :error='dp.errors.description')
        .form-group
            label.login-label Commencement date (IST)
            .row.col-sm-6
                date-picker(v-model='form_data.start', :config='datePickeroptions')
        duration(
            v-model='form_data.duration',
            name='duration',
            label='Course duration',
            :error='dp.errors.duration',
            required
        )
        custom-input(
            v-model='form_data.eligibility',
            name='eligibility',
            label='Eligibility',
            :error='dp.errors.eligibility',
            required
        )
        custom-input(
            v-model='form_data.course_fees',
            name='course_fees',
            label='Course fees',
            :error='dp.errors.course_fees',
            required
        )
        uploader(
            v-model='form_data.course_image',
            name='course_image',
            label='Featured image',
            :error='dp.errors.course_image'
        )
        uploader(
            v-model='form_data.brochure_file',
            name='brochure_file',
            label='Brochure',
            :error='dp.errors.brochure_file'
        )
        uploader(
            v-model='form_data.application_file',
            name='application_file',
            label='Application',
            :error='dp.errors.application_file'
        )
        seo-fields(:fields='form_data', @onChange='onSeoFieldChanged')
    update-widget(
        label='Course status',
        :update='isUpdateForm',
        :submitted='dp.submitted',
        :status='submissionResponse',
        @publish='onSubmit',
        @cancel='$emit("cancel")',
        @save='saveDraft'
    )
        custom-select(
            v-model='form_data.status',
            :error='dp.errors.status',
            :options='publish_options',
            label='Course status',
            name='status',
            required
        )
</template>

<script>
import { DataPoster } from '@rheas/vuer';
import Duration from '@components/duration';
import Uploader from '@components/uploader';
import SeoFields from '@components/seoWidget';
import CustomEditor from '@components/editor';
import UpdateWidget from '@components/updateWidget';
import CustomInput from '@components/formGroupInput';
import CustomSelect from '@components/formGroupSelect';

import { extendMoment } from 'moment-range';
import DatePicker from 'vue-bootstrap-datetimepicker';
import 'pc-bootstrap4-datetimepicker/build/css/bootstrap-datetimepicker.css';

export default {
    name: 'CourseForm',
    props: ['course'],
    created: function () {
        this.form_data = this.course || {};

        this.form_data.duration = this.form_data.duration || 1;
        this.form_data.status = this.form_data.status || 'active';
        this.form_data.start = this.form_data.start ? moment(this.form_data.start) : moment();

        this.updateDatePickerOptions();

        //Turn form_data.start back to normal text
        this.form_data.start = this.form_data.start.format('DD/MM/YYYY h:mm A');
    },
    data: function () {
        return {
            form_data: {
                title: '',
                snippet: '',
                description: '',
                duration: '',
                start: '',
                eligibility: '',
                course_fees: '',
                status: '',
                course_image: '',
                brochure_file: '',
                application_file: '',
                meta_title: '',
                meta_description: '',
                meta_keywords: '',
            },
            publish_options: {
                active: 'Activate',
                inactive: 'Inactivate',
                draft: 'Draft',
            },
            datePickeroptions: {
                format: 'DD/MM/YYYY h:mm A',
                useCurrent: false,
            },
            dp: new DataPoster('/api/admin/course'),
        };
    },
    methods: {
        onSeoFieldChanged: function (field, new_value) {
            this.form_data[field] = new_value;
        },
        updateDatePickerOptions: function () {
            this.datePickeroptions.defaultDate = this.form_data.start;
            this.datePickeroptions.minDate = moment().isBefore(this.form_data.start)
                ? moment()
                : this.form_data.start;

            if (this.datePickeroptions.minDate.isBefore(moment())) {
                this.datePickeroptions.disabledDates = Array.from(
                    extendMoment(moment)
                        .range(this.datePickeroptions.minDate, moment().subtract(1, 'days'))
                        .by('days'),
                );
            }
        },
        saveDraft: function () {
            this.form_data.status = 'draft';

            this.onSubmit();
        },
        onSubmit: function () {
            const url = '/api/admin/course' + (this.isUpdateForm ? `/${this.form_data.id}` : '');
            const form_data = this.form_data;

            if (this.isUpdateForm) {
                form_data['_method'] = 'PATCH';
            }
            this.dp.formPost(url, form_data, () => this.$emit('cancel'), this.onError);
        },
    },
    computed: {
        submissionResponse: function () {
            return {
                error: this.dp.errors.server_error ? true : false,
                message: this.dp.errors.server_error || '',
            };
        },
        isUpdateForm: function () {
            return !!this.form_data.id;
        },
    },
    components: {
        DatePicker,
        Uploader,
        Duration,
        SeoFields,
        CustomInput,
        UpdateWidget,
        CustomSelect,
        CustomEditor,
    },
};
</script>