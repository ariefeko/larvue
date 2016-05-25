@extends('layout')

@section('content')

    <div id="UserController" style="padding-top: 2em">

        <div class="alert alert-danger" v-if="!isValid">
            <ul>
                <li v-show="!validation.name">Name field is required.</li>
                <li v-show="!validation.email">Please input correct email format.</li>
                <li v-show="!validation.address">address field is required.</li>
            </ul>
        </div>

        {!! Form::open(array('url' => '#', 'method' => 'POST', 'class' => 'form-horizontal', '@submit.prevent' => 'AddNewUser')) !!}
            <div class="form-group">
                <label for="name" class="col-md-4 control-label">Name</label>
                <div class="col-md-6">
                    <input v-model="newUser.name" type="text" id="name" name="name" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-md-4 control-label">Email</label>
                <div class="col-md-6">
                    <input v-model="newUser.email" type="text" id="email" name="email" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="address" class="col-md-4 control-label">Address</label>
                <div class="col-md-6">
                    <input v-model="newUser.address" type="text" id="address" name="address" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-9 col-md-offset-4">
                    <button :disabled="!isValid" type="submit" class="btn btn-default" v-if="!edit">Add New User</button>

                    <button :disabled="!isValid" type="submit" class="btn btn-default" v-if="edit" @click="EditUser(newUser.id)">Edit User</button>
                </div>
            </div>
        {!! Form::close() !!}

        <div class="alert alert-success" transition="success" v-if="success">Add new user successfully.</div>

        <hr>

        <table class="table">
            <thead>
                <th>ID</th>
                <th>NAME</th>
                <th>EMAIL</th>
                <th>ADDRESS</th>
                <th>CREATED AT</th>
                <th>UPDATED AT</th>
                <th>CONTROLLER</th>
            </thead>

            <tbody>
                <tr v-for="user in users" debounce="500">
                    <td>@{{ user.id }}</td>
                    <td>@{{ user.name }}</td>
                    <td>@{{ user.email }}</td>
                    <td>@{{ user.address }}</td>
                    <td>@{{ user.created_at }}</td>
                    <td>@{{ user.updated_at }}</td>
                    <td>
                        <button class="btn btn-primary btn-sm" @click="ShowUser(user.id)">Edit</button>
                        <button class="btn btn-danger btn-sm" @click="RemoveUser(user.id)">Remove</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

@stop

@push('scripts')
    <script src="/js/script.js"></script>

    <style>
        .success-transition {
            transition: all .5s ease-out;
        }
        .success.enter, .success.leave {
            opacity: 0;
        }
    </style>
@endpush