@extends('layouts.master')

@section('title', 'Auction View')

@section('breadcrumb-title', 'Auction View')
@section('breadcrumb-item')
    <li class="breadcrumb-item">Auction</li>
    <li class="breadcrumb-item active">View</li>
@endsection

@section("content")
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="pull-left">Auction</h4>
                        <a href="{{route('auctions.index')}}"
                           class="btn btn-primary pull-right">
                            <i class="fa fa-arrow-left">
                               Back to Index</i>
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
{{--                                    <th>Icon</th>--}}
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{$auction->product_title}}</td>
                                        <td>{{$auction->description}}</td>
{{--                                        <td>{{$auction->icon}}</td>--}}
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
