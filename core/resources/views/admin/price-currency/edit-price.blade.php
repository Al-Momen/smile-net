@extends('admin.layout.master')
@section('title')
    Currency
@endsection
@section('page-name')
    Currency
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
            <a href="{{ route('admin.ticket.type.index') }}">
                <span class="active-path g-color">Currency</span>
            </a>
            <i class="las la-angle-right"></i>
            <a href="#">
                <span class="active-path g-color">Edit Currency</span>
            </a>
        </div>
        <div class="view-prodact">

            <a data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="las la-plus"></i>
                <span>Add Currency</span>
            </a>
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
            <!-- Button trigger modal -->
            <div>

                <div>
                    <form action="{{ route('admin.price.currency.update', $currency->id) }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="modal-content">

                                <div class="modal-header bg--primary">
                                    <h5 class="modal-title text-white">@lang('Add Currency')</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>@lang('Currency Name')</label>
                                        <input class="form-control form--control" type="text" name="name"
                                            placeholder="@lang('e.g.USD')" required value="{{ $currency->name }}">
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('Currency Code')</label>
                                        <input class="form-control form--control" type="number" name="code"
                                            placeholder="@lang('e.g.code')" required value="{{ $currency->code }}">
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('Currency Symbol')</label>
                                        <input class="form-control form--control" type="text" name="symbol"
                                            placeholder="@lang('e.g.$')" required value="{{ $currency->symbol }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><a
                                    href="{{ route('admin.price.index') }}">Close</a></button>
                            <button type="submit" class="btn btn-primary">update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
@endsection
