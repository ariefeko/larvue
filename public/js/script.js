var vm = new Vue({
    el: '#UserController',

    methods: {

        fetchUser: function () {
            this.$http.get('/api/users', function(data) {
                this.$set('users', data)
            })
        }

    },

    ready: function(){
        this.fetchUser()
    }
});