@extends('admin.layout.master')
@section('permission', 'active')
@section('Role Management', 'open')
@section('title')
    @lang('admin_action.list_page_title')
@endsection
@section('page-name')
    @lang('admin_action.list_page_sub_title')
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('dashboard') }}">@lang('admin_action.breadcrumb_title')</a>
    </li>
    <li class="breadcrumb-item active">
        @lang('admin_action.breadcrumb_sub_title')
    </li>
@endsection
@php
$roles = userRolePermissionArray();
@endphp
@section('content')
    @extends('admin.layout.master')

@section('role', 'active')
@section('Role Management', 'open')
@section('title')
    @lang('admin_role.list_page_title')
@endsection
@section('page-name')
    @lang('admin_role.list_page_sub_title')
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('admin_role.breadcrumb_title') </a>
    </li>
    <li class="breadcrumb-item active">@lang('admin_role.breadcrumb_sub_title')
    </li>
@endsection
@php
$roles = userRolePermissionArray();
@endphp
@section('content')
    <div class="dashboard-title-part">
        <div class="view-prodact">
            <a href="#">
                <i class="las la-arrow-left align-middle me-1"></i>
                <span>Go Back</span>
            </a>
        </div>
        <div class="dashboard-path">
            <span class="main-path">Dashboards</span>
            <i class="las la-angle-right"></i>
            <span class="active-path g-color">Manage Action</span>
        </div>
        <div class="view-prodact">
            <a href="{{ route('admin.permission.new') }}">
                <i class="las la-plus align-middle me-1"></i>
                <span>@lang('form.new_action_form_title')</span>
            </a>
        </div>
    </div>
    <!-- body-wrapper-start -->
    <div class="user-detail-area">
        <div class="user-info-header two">
            <h5 class="title">@lang('form.new_action_form_title')</h5>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="dashboard-form-area two mt-10">
                    {!! Form::open(['route' => 'admin.permission.store', 'method' => 'post']) !!}
                    @csrf
                    <div class="row mb-30-none">
                        <div class="col-lg-12 mb-30">
                            <div class="row justify-content-center mb-10-none">
                                <div class="col-lg-4 form-group">
                                    <label>Action Slug*</label>
                                    {!! Form::text('permission_slug', null, [
                                        'class' => 'form-control form--control mb-1',
                                        'data-validation-required-message' => __('form.field_required'),
                                        'placeholder' => __('form.new_action_form_placeholder_menuslug'),
                                    ]) !!}
                                    @if ($errors->has('permission_slug'))
                                        <div class="alert alert-danger">
                                            <strong>{{ $errors->first('permission_slug') }}</strong>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-lg-4 form-group">
                                    <label>Action Display Name*</label>
                                    {!! Form::text('display_name', null, [
                                        'class' => 'form-control form--control',
                                        'data-validation-required-message' => __('form.field_required'),
                                        'placeholder' => __('form.new_action_form_placeholder_name'),
                                    ]) !!}

                                    @if ($errors->has('display_name'))
                                        <div class="alert alert-danger">
                                            <strong>{{ $errors->first('display_name') }}</strong>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-lg-4 form-group">
                                    <label>Action Menu*</label>
                                    {!! Form::select('permission_group', $group, null, [
                                        'class' => 'form-control form--control',
                                        'placeholder' => __('form.new_action_form_placeholder_menu'),
                                        'data-validation-required-message' => __('form.field_required')
                                    ]) !!}
                                    @if ($errors->has('permission_group'))
                                        <div class="alert alert-danger">
                                            <strong>{{ $errors->first('permission_group') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pro-btn-area">
                        <button type="submit" class="btn btn--base"> @lang('form.btn_save')</button>
                        <a href="{{ route('admin.permission.new') }}">
                            <button type="button" class="btm btn--base bg--danger">
                                @lang('form.btn_cancle')
                            </button>
                        </a>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
