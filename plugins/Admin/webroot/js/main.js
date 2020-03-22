var app = new Vue({
    delimiters: '[', ']'],
    el: '#nh-app',
    data: {
        name: '',
        email: '',
        country: '',
        city: '',
        job: '',
        contacts: []
    },
    mounted: function() {
        console.log('Hello from Vue!')
        this.getContacts()
    },

    methods: {
        getUsers: function() {
            axios.get('/api/contacts.php')
            .then(function (response) {
                console.log(response.data);
                app.contacts = response.data;

            })
            .catch(function (error) {
                console.log(error);
            });
        },
        createUser: function() {},
        resetForm: function() {}
    }
})