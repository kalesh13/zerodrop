export default {
    data: function() {
        return {
            id: '',
            edit: false,
        };
    },
    methods: {
        toggleScreen: function(is_edit_screen, id) {
            this.id = id;
            this.edit = is_edit_screen;
        },
    },
};
