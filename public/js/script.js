// Regex (Regular Expression) for email validation
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
        newUser: {id: '', name: '', email: '', address: ''},

        success: false,

        edit: false
    },

    methods: {

        fetchUser: function () {
            var data = []
            var users = []
            // alert([users, data])
            this.$http.get('/api/users', function(data) {
                this.$set('users', data)
            })
        },

        RemoveUser: function (id) {
            var ConfirmBox = confirm("Are you sure, you want to remove this User?")

            if(ConfirmBox) this.$http.delete('/api/users/' + id)

            // this.fetchUser()
            window.location.reload()
        },

        EditUser: function (id) {
            var user = this.newUser

            this.newUser = {id:'', name:'', email:'', address:''}

            this.$http.patch('/api/users/' + id, user, function (data) {
                console.log(data)
            })

            this.edit = false

            // this.fetchUser()
            window.location.reload()
        },

        ShowUser: function (id) {
            this.edit = true

            this.$http.get('/api/users/' + id, function(data) {
                this.newUser.id = data.id
                this.newUser.name = data.name
                this.newUser.email = data.email
                this.newUser.address = data.address
            })
        },

        AddNewUser: function () {
            //User Input
            var user = this.newUser

            // Clear form input
            this.newUser = {name:'', email:'', address:''}

            // Send post request
            this.$http.post('/api/users', user)

            // Show success message
            self = this
            this.success = true
            setTimeout(function () {
                self.success = false
                // alert("timeout")
            }, 5000)

            // Reload
            this.fetchUser()
            // window.location.reload()
        }

    },

    computed: {
        validation: function () {
            return {
                // !! (convert right value into boolean type)
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