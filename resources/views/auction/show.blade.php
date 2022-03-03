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

                                            <img style="margin-bottom: 20px" height="30px" width="250px" class="img-fluid" src="{{asset('storage/'.$image)}}" alt="">
                                        @endforeach

                                                @endif</p></td>

                            </tr>

                        </div>
{{--                        <div class="table">--}}
{{--                            <div class="table-responsive product-table">--}}
{{--                                <div id="basic-1_wrapper" class="dataTables_wrapper no-footer">--}}

{{--                                    <table class="display dataTable no-footer" id="basic-1" role="grid" aria-describedby="basic-1_info">--}}
{{--                                        <thead>--}}
{{--                                        <tr role="row"> <th style="width: 46px;">Sr#</th><th style="width: 46px;">Image</th>--}}
{{--                                            <th style="width: 375.594px;">Title</th><th  style="width: 56.2812px;">Category</th><th  style="width: 55.8906px;">Amount</th><th  style="width: 67.2031px;">Start date</th><th  style="width: 120.031px;">Action</th></tr>--}}
{{--                                        </thead>--}}
{{--                                        <tbody>--}}
{{--                                        @foreach($auctions as $auction)--}}

{{--                                            <tr role="row" class="odd">--}}
{{--                                                <td>{{$loop->iteration}}</td>--}}

{{--                                                <td class="sorting_1"><img style="height: 70px" src="{{asset('storage/'. $auction->images[0])}}" alt="" data-original-title="" title=""></td>--}}
{{--                                                <td>--}}
{{--                                                    <h6> {{$auction->product_title}}</h6>--}}
{{--                                                </td>--}}
{{--                                                <td>{{$auction->category->name}}</td>--}}

{{--                                                <td>$10</td>--}}
{{--                                                <td>2011/04/25</td>--}}
{{--                                                <td>--}}
{{--                                                    <a href="{{ route('auctions.edit', ['auction' => $auction->id]) }}"--}}
{{--                                                       class="btn btn-primary btn-sm m-1 p-2" title="Edit">--}}
{{--                                                        <i class="fa fa-edit"></i>--}}
{{--                                                    </a>--}}
{{--                                                    <a href="{{ route('auctions.show', ['auction' => $auction->id]) }}"--}}
{{--                                                       class="btn btn-success btn-sm m-1 p-2" title="View">--}}
{{--                                                        <i class="fa fa-eye"></i>--}}
{{--                                                    </a>--}}
{{--                                                    <form action="{{ route('auctions.destroy', ['auction' => $auction->id]) }}"--}}
{{--                                                          method="post">--}}
{{--                                                        @method('DELETE')--}}
{{--                                                        @csrf--}}
{{--                                                        <button type="submit"--}}
{{--                                                                class="btn btn-danger btn-sm m-1 p-2" title="Delete">--}}
{{--                                                            <i class="fa fa-trash"></i>--}}
{{--                                                        </button>--}}
{{--                                                    </form>--}}
{{--                                                </td>--}}
{{--                                            </tr>--}}
{{--                                        @endforeach--}}
{{--                                        </tbody>--}}
{{--                                    </table>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
