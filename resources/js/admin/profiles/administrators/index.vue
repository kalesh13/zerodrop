<template lang="pug">
.section.single-section
    admin-table(v-if='!edit', @toggle='toggleScreen')
</template>

<script>
import AdminTable from './table';
import editable from '@mixins/editable';

export default {
    name: 'Administrators',
    mixins: [editable],
    components: { AdminTable },
};
</script>