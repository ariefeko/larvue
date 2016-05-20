@extends('layout')

@section('content')

    <div id="UserController" style="padding-top: 2em">

        <table class="table">
            <thead>
                <th>ID</th>
                <th>NAME</th>
                <th>EMAIL</th>
                <th>ADDRESS</th>
                <th>CREATED AT</th>
                <th>UPDATED AT</th>
            </thead>

            <tbody>
                <tr v-for="user in users">
                    <td>@{{ user.id }}</td>
                    <td>@{{ user.name }}</td>
                    <td>@{{ user.email }}</td>
                    <td>@{{ user.address }}</td>
                    <td>@{{ user.created_at }}</td>
                    <td>@{{ user.updated_at }}</td>
                </tr>
            </tbody>
        </table>
    </div>

@stop

@push('scripts')
    <script src="/js/script.js"></script>
@endpush