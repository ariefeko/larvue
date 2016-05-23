Vue.config.debug = true;
var emailRE = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/

var vm = new Vue({
    http: {
      root: '/root',
      headers: {
        'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
      }
    },

    el: '#UserController',

    data: {
        newUser: {
            name: '',
            email: '',
            address: ''
        }
    },

    methods: {

        fetchUser: function () {
            this.$http.get('/api/users', function(data) {
                this.$set('users', data)
            })
        },

        AddNewUser: function () {
            //User Input
            var user = this.newUser

            // alert(user.address)

            // Clear form input
            this.newUser = {name:'', email:'', address:''}

            // Send post request
            this.$http.post('/api/users/', user)
        }

    },

    computed: {
        validation: function () {
            return {
                name: !!this.newUser.name.trim(),
                email: emailRE.test(this.newUser.email),
                address: !!this.newUser.address.trim()
            }
        },

        isValid: function () {
            var validation = this.validation
            // Object(keys) : returns an array whose elements are strings corresponding to the enumerable properties found directly upon object
            // every(callback) : if callback return a true value for all elements, every will return true
            return Object.keys(validation).every(function (key) {
                return validation[key]
            })
        }
    },

    ready: function(){
        this.fetchUser()
    }
});