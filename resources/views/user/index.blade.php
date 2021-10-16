@extends('layouts.master')

@section('title', 'Users')

@section('breadcrumb-title', 'Users')
@section('breadcrumb-item')
    <li class="breadcrumb-item">User</li>
    <li class="breadcrumb-item active">List</li>
@endsection

@section("content")
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="pull-left">Users List</h4>
{{--                        <a href="{{route('users.create')}}"--}}
{{--                           class="btn btn-primary pull-right">--}}
{{--                            <i class="fa fa-plus">--}}
{{--                                Add New User</i>--}}
{{--                        </a>--}}
                    </div>
                    <div class="card-body">
                        <div class="table">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Sr#</th>
                                    <th>Name</th>
                                    <th>Email</th>
{{--                                    <th>Actions</th>--}}
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
{{--                                        <td>--}}
{{--                                            <a href="{{ route('users.edit', ['user' => $user->id]) }}"--}}
{{--                                                class="btn btn-primary btn-sm m-1 p-2" title="Edit">--}}
{{--                                                <i class="fa fa-edit"></i>--}}
{{--                                            </a>--}}
{{--                                            <a href="{{ route('users.show', ['user' => $user->id]) }}"--}}
{{--                                                class="btn btn-success btn-sm m-1 p-2" title="View">--}}
{{--                                                <i class="fa fa-eye"></i>--}}
{{--                                            </a>--}}
{{--                                            <form action="{{ route('users.destroy', ['user' => $user->id]) }}"--}}
{{--                                                method="post">--}}
{{--                                                @method('DELETE')--}}
{{--                                                @csrf--}}
{{--                                                <button type="submit"--}}
{{--                                                   class="btn btn-danger btn-sm m-1 p-2" title="Delete">--}}
{{--                                                    <i class="fa fa-trash"></i>--}}
{{--                                                </button>--}}
{{--                                            </form>--}}
{{--                                        </td>--}}
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
{{--                        {{$modules->Links()}}--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
