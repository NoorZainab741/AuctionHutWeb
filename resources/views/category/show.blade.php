@extends('layouts.master')

@section('title', 'Category View')

@section('breadcrumb-title', 'Category View')
@section('breadcrumb-item')
    <li class="breadcrumb-item">Category</li>
    <li class="breadcrumb-item active">View</li>
@endsection

@section("content")
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="pull-left">Category</h4>
                        <a href="{{route('categories.index')}}"
                           class="btn btn-primary pull-right">
                            <i class="fa fa-arrow-left">
                               Back to Index</i>
                        </a>
                    </div>
                    <div class="card-body">
                        <div>
                            <tr>
                                <td><h4>
                                    Name</h4>
                                    <p style="font-size: 20px">
                                        {{$category->name}}
                                    </p></td>
                                <br>
                                <td><h4>Icon</h4>  <p>
                                        @if($category->icon == null)
                                            No Icon
                                        @else
                                            <img height="270px" width="270px" class="img-fluid" src="{{asset('storage/'.$category->icon)}}" alt="">
                                        @endif</p></td>

                            </tr>
                        </div>
                        </div>

                    </div>
            </div>
        </div>
    </div>
@endsection
