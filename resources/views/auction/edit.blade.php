@extends('layouts.master')

@section('title', 'Edit')

@section('breadcrumb-title', 'Edit')

@section('breadcrumb-item')
    <li class="breadcrumb-item">Auction</li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@extends('layouts.form')

@section('form-heading', 'Edit Auction')

@section('route', route('auctions.update', ['auction' => $auction->id]))

@section('form-fields')
    @include('auction.fields')
    @method('PUT')
@endsection

@section('submit-text', 'Update Auction')
