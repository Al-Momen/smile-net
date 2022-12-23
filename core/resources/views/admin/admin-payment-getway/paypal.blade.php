@extends('admin.layout.master')
@section('title')
    Paypal-Getway
@endsection
@section('page-name')
    Paypal-Getway
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
            <span class="active-path g-color">Paypal-Getway</span>


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
                    <form action="{{ route('admin.update.paypal.paymentgetway', $adminPaypal->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="modal-content">
                                <div class="modal-header bg--primary">
                                    <h5 class="modal-title text-white">@lang('Paypal-Getway')</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>@lang('Name')</label>
                                        <input class="form-control form--control" type="text" name="name"
                                            placeholder="@lang('name')" required value="{{ $adminPaypal->name }}">
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('Image')</label>
                                        <input class="form-control form--control" type="file" name="image"
                                            placeholder="@lang('Image')" required value="{{ $adminPaypal->image }}">
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('Client-Id')</label>
                                        <input class="form-control form--control" type="text" name="client_id"
                                            placeholder="@lang('Client-Id')" required value="{{ $adminPaypal->client_id }}">
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('Secret-key')</label>
                                        <input class="form-control form--control" type="text" name="secret_key"
                                            placeholder="@lang('Secret-key')" required value="{{ $adminPaypal->secret_key }}">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>@lang('Fixed Charge')</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text set_currency" id="basic-addon1">{{$currency->symbol}}</span>
                                            <input class="form-control form--control" type="text" name="fixed_change"
                                                placeholder="@lang('Fixed Charge')" required
                                                value="{{ $adminPaypal->fixed_change }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('Percent Charge')</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text set_currency" id="basic-addon1">%</span>
                                            <input class="form-control form--control" type="text" name="percent_change"
                                                placeholder="@lang('Percent Charge')" required
                                                value="{{ $adminPaypal->percent_change }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('App-id')</label>
                                        <input class="form-control form--control" type="text" name="app_id"
                                            placeholder="@lang('App-id')" required value="{{ $adminPaypal->app_id }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="mode" class="form-label">@lang('Mode')</label>
                                        <select class="form-select form-select-md mb-3 " style="padding: 12px 10px;"
                                            aria-label=".form-select-lg example" name="mode">

                                            <option @if ($adminPaypal->mode == 'sandbox') selected @endif value="sandbox">
                                                Sandbox</option>
                                            <option @if ($adminPaypal->mode == 'live') selected @endif value="live"> Live
                                            </option>
                                        </select>
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
