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
                            <div class="table-responsive product-table">
                                <div id="basic-1_wrapper" class="dataTables_wrapper no-footer">

                            <table class="display dataTable no-footer" id="basic-1" role="grid" aria-describedby="basic-1_info">
                                <thead>
                                <tr role="row"> <th style="width: 46px;">Sr#</th><th style="width: 46px;">Image</th>
                                    <th style="width: 375.594px;">Title</th><th  style="width: 56.2812px;">Category</th><th  style="width: 55.8906px;">Amount</th><th  style="width: 67.2031px;">Start date</th><th  style="width: 120.031px;">Action</th></tr>
                                </thead>
                                <tbody>
                                @foreach($auctions as $auction)

                                <tr role="row" class="odd">
                                    <td>{{$loop->iteration}}</td>

                                    <td class="sorting_1"><img style="height: 70px" src="{{asset('storage/'. $auction->images[0])}}" alt="" data-original-title="" title=""></td>
                                    <td>
                                        <h6> {{$auction->product_title}}</h6>
                                    </td>
                                    <td>{{$auction->category->name}}</td>

                                    <td>$10</td>
                                    <td>2011/04/25</td>
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
                            </div>
                        </div>
{{--                        {{$modules->Links()}}--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
