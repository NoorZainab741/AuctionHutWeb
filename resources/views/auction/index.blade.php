@extends('layouts.master')

@section('title', 'Auctions')

@section('breadcrumb-title', 'Auctions')
@section('breadcrumb-item')
    <li class="breadcrumb-item">Auctions</li>
    <li class="breadcrumb-item active">List</li>
@endsection

@section("content")
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="pull-left">Auctions List</h4>
                        <a href="{{route('auctions.create')}}"
                           class="btn btn-primary pull-right">
                            <i class="fa fa-plus">
                                Add New Auction</i>
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Sr#</th>
                                    <th>Name</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($auctions as $auction)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$auction->product_title}}</td>
                                        <td>
                                            <a href="{{ route('auctions.edit', ['auction' => $auction->id]) }}"
                                                class="btn btn-primary btn-sm m-1 p-2" title="Edit">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="{{ route('auctions.show', ['auction' => $auction->id]) }}"
                                                class="btn btn-success btn-sm m-1 p-2" title="View">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <form action="{{ route('auctions.destroy', ['auction' => $auction->id]) }}"
                                                method="post">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit"
                                                   class="btn btn-danger btn-sm m-1 p-2" title="Delete">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
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
