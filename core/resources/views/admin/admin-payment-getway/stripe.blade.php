@extends('admin.layout.master')
@section('title')
    Stripe-Getway
@endsection
@section('page-name')
    Stripe-Getway
@endsection
@php
    $roles = userRolePermissionArray();
@endphp
@section('content')
    <div class="dashboard-title-part">
        <h5 class="title">Dashboard</h5>
        <div href="" class="dashboard-path">
            <a href={{ route('admin.dashboard') }}>
                <span class="main-path">Dashboards</span>
            </a>
            <i class="las la-angle-right"></i>
            <span class="active-path g-color">Stripe-Getway</span>


        </div>
        <div class="view-prodact">

        </div>
    </div>
    <div class="table-content">
        <div class="shadow-lg p-4 card-1 my-3">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('success') }}!</strong> <button type="button" class="btn-close"
                        data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <!-- Button trigger modal -->
            <div>
                <div>
                    <form action="{{ route('admin.update.stripe.paymentgetway', $adminStripe->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="modal-content">
                                <div class="modal-header bg--primary">
                                    <h5 class="modal-title text-white">@lang('Stripe-Getway')</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>@lang('Name')</label>
                                        <input class="form-control form--control" type="text" name="name"
                                            placeholder="@lang('name')" required value="{{ $adminStripe->name }}">
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('Image')</label>
                                        <input class="form-control form--control" type="file" name="image"
                                            placeholder="@lang('Image')" required value="{{ $adminStripe->image }}">
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('Stripe-key')</label>
                                        <input class="form-control form--control" type="text" name="stripe_key"
                                            placeholder="@lang('Stripe-key')" required value="{{ $adminStripe->stripe_key }}">
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('Stripe-Secret')</label>
                                        <input class="form-control form--control" type="text" name="stripe_secret"
                                            placeholder="@lang('Stripe-Secret')" required value="{{ $adminStripe->stripe_secret }}">
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
