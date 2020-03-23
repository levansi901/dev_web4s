// if (typeof _admin_path !== 'undefined') {
//     var _admin_path = '/admin';
// }

if (typeof _api_path == 'undefined') {
    var _api_path = '/api';
}

var app = new Vue({
    delimiters: ['[', ']'],
    el: '#nh-app',
    data: {
        name: '',
        email: '',
        country: '',
        city: '',
        job: '',
        users: []
    },
    mounted: function() {
        this.getUsers()
    },

    methods: {
        getUsers: function() {
            axios.get(_api_path + '/user/list')
            .then(function (response) { 
                console.log(response);
                app.users = response.data;

            })
            .catch(function (error) {
                console.log(error);
            });
        },
        createUser: function() {},
        resetForm: function() {}
    }
})