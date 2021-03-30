<template lang="pug">
extends template.pug
block page_title
    span About Page
block page_form
    .course-form
        uploader(v-model='form_data.logo', label='Site Logo', name='logo', :error='pu.errors.logo')
        custom-input(
            v-model='form_data.contact_email',
            :error='pu.errors.contact_email',
            label='Contact email address',
            name='contact_email',
            required
        )
        .address-title Address
        custom-input(
            v-model='form_data.address_line_1',
            :error='pu.errors.address_line_1',
            label='Address line 1 (Company name)',
            name='address_line_1',
            required
        )
        custom-input(
            v-model='form_data.street_address',
            :error='pu.errors.street_address',
            label='Address line 2',
            name='street_address',
            required
        )
        custom-input(
            v-model='form_data.city',
            :error='pu.errors.city',
            label='City',
            name='city',
            required
        )
        custom-input(
            v-model='form_data.state',
            :error='pu.errors.state',
            label='State',
            name='state',
            required
        )
        custom-input(
            v-model='form_data.country',
            :error='pu.errors.country',
            label='Country',
            name='country',
            required
        )
        custom-input(
            v-model='form_data.pin',
            :error='pu.errors.pin',
            label='Postal code',
            name='pin',
            required
        )
        .address-title Phone numbers
        custom-input(
            v-model='form_data.phone_1',
            :error='pu.errors.phone_1',
            label='Phone number 1',
            name='phone_1',
            required
        )
        custom-input(
            v-model='form_data.phone_2',
            :error='pu.errors.phone_2',
            label='Phone number 2',
            name='phone_2',
            required
        )
        .address-title Social links
        custom-input(
            v-model='form_data.fb_url',
            :error='pu.errors.fb_url',
            label='Facebook page url',
            name='fb_url',
            required
        )
        custom-input(
            v-model='form_data.twitter_url',
            :error='pu.errors.twitter_url',
            label='Twitter profile url',
            name='twitter_url',
            required
        )
        custom-input(
            v-model='form_data.insta_url',
            :error='pu.errors.insta_url',
            label='Instagram profile url',
            name='insta_url',
            required
        )
        custom-input(
            v-model='form_data.youtube_url',
            :error='pu.errors.youtube_url',
            label='YouTube channel url',
            name='youtube_url',
            required
        )
</template>

<script>
import { DataFetcher } from '@rheas/vuer';
import { PageUpdater } from './PageUpdater';
import Uploader from '@components/uploader';
import SeoFields from '@components/seoWidget';
import LoadingComponent from '@components/loading';
import UpdateWidget from '@components/updateWidget';
import CustomInput from '@components/formGroupInput';

export default {
    name: 'Settings',
    mounted: function () {
        this.df.fetchData(null, (data) => (this.form_data = data));
    },
    data: function () {
        return {
            form_data: {
                logo: '',
                contact_email: '',
                address_line_1: '',
                street_address: '',
                city: '',
                state: '',
                country: '',
                pin: '',
                phone_1: '',
                phone_2: '',
                fb_url: '',
                twitter_url: '',
                insta_url: '',
                youtube_url: '',
            },
            pu: new PageUpdater(),
            df: new DataFetcher('/api/page/settings'),
        };
    },
    methods: {
        onSubmit: function () {
            this.pu.updatePage('/api/admin/page/settings', this.form_data);
        },
    },
    components: { LoadingComponent, SeoFields, UpdateWidget, Uploader, CustomInput },
};
</script>