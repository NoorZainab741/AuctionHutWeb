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
                        <div>
                            <tr>
                                <td><h4>
                                        Status</h4>
                                    <p style="font-size: 20px">
                                        {{$auction->status}}
                                    </p></td>
                                <br>
                                <td><h4>
                                        Title</h4>
                                    <p style="font-size: 20px">
                                        {{$auction->product_title}}
                                    </p></td>
                                <br>
                                <td><h4>
                                        Created by</h4>
                                    <p style="font-size: 20px">
                                        {{$auction->user->name}}
                                    </p></td>
                                <br>
                                <td><h4>
                                        Category</h4>
                                    <p style="font-size: 20px">
                                        {{$auction->category->name}}
                                    </p></td>
                                <br>

                                <td><h4>
                                        Time</h4>
                                    <p style="font-size: 20px">
                                        {{$auction->time}} hours
                                    </p></td>
                                <br>
                                <td><h4>
                                        Starting Price</h4>
                                    <p style="font-size: 20px">
                                        {{$auction->starting_price}} Pkr
                                    </p></td>
                                <br>
                                <td><h4>
                                        Description</h4>
                                    <p style="font-size: 20px">
                                        {{$auction->description}}
                                    </p></td>
                                <br>
                                <td><h4>Images</h4>  <p>
                                        @if($auction->images == null)
                                            No Images
                                        @else
                                        @foreach($auction->images as $image)

                                            <img style="margin-bottom: 20px" height="400px" width="700px" class="img-fluid" src="{{asset('storage/'.$image)}}" alt="">
                                        @endforeach
                                                @endif</p></td>

                            </tr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
