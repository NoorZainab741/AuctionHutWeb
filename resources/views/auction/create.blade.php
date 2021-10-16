
@extends('layouts.master')

@section('title', 'Create')

@section('breadcrumb-title', 'Create')

@section('breadcrumb-item')
    <li class="breadcrumb-item">Auction</li>
    <li class="breadcrumb-item active">Create</li>
@endsection

@extends('layouts.form')

@section('form-heading', 'Add New Auction')

@section('route', route('auctions.store'))

@section('form-fields')
    @include('auction.fields')
@endsection

@section('submit-text', 'Create Auction')
