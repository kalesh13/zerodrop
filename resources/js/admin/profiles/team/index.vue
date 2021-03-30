<template lang="pug">
.section.single-section
    members-table(v-if='!edit', @toggle='toggleScreen')
    member-editor(v-else, @toggle='toggleScreen', :id='id')
</template>

<script>
import MembersTable from './table';
import MemberEditor from './editor';
import editable from '@mixins/editable';

export default {
    name: 'Teams',
    mixins: [editable],
    components: { MemberEditor, MembersTable },
};
</script>