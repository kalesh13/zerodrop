<template lang="pug">
.seo-fields
    .address-title SEO fields
    custom-input(v-model='meta_title', label='Meta title', name='meta_title')
    custom-input(v-model='meta_description', label='Meta Description', name='meta_description')
    custom-input(v-model='meta_keywords', label='Meta Keywords', name='meta_keywords')
</template>

<script>
import CustomInput from '@components/formGroupInput';

export default {
    name: 'SeoWidget',
    props: ['fields'],
    watch: {
        fields: function (new_val) {
            this.meta_title = new_val.meta_title;
            this.meta_keywords = new_val.meta_keywords;
            this.meta_description = new_val.meta_description;
        },
        meta_title: function (new_val) {
            this.$emit('onChange', 'meta_title', new_val);
        },
        meta_keywords: function (new_val) {
            this.$emit('onChange', 'meta_keywords', new_val);
        },
        meta_description: function (new_val) {
            this.$emit('onChange', 'meta_description', new_val);
        },
    },
    data: function () {
        return {
            meta_title: this.fields.meta_title,
            meta_keywords: this.fields.meta_keywords,
            meta_description: this.fields.meta_description,
        };
    },
    components: { CustomInput },
};
</script>