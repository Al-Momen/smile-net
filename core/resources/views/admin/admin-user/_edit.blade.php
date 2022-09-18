@extends('admin.layout.master')
@section('user-group', 'active')
@section('User Management', 'open')
@section('title')
    @lang('user_group.edit_page_title')
@endsection
@section('page-name')
    @lang('user_group.list_page_sub_title')
@endsection
@section('content')
    <div class="dashboard-title-part">
        <h5 class="title">Dashboard</h5>
        <div href="" class="dashboard-path">
            <a href={{ route('admin.dashboard') }}>
                <span class="main-path">Dashboards</span>
            </a>
            <i class="las la-angle-right"></i>
            <a href="{{ route('admin.admin-user') }}">
                <span class="active-path g-color">Admin Users</span>
            </a>
        </div>
        <div class="view-prodact">
            <a href="{{ route('admin.admin-user.new') }}">
                <i class="las la-plus align-middle me-1"></i>
                <span>Create Admin User</span>
            </a>
        </div>
    </div>
    <div class="table-area">
        <div class="row">
            <div class="col-lg-12">
                <div class="dashboard-form-area">
                    <div class="card-header">
                        Update Menu
                    </div>
                    <div class="card-body">
                        {!! Form::open([ 'route' => ['admin.user-group.update', $userGroup->id], 'method' => 'post' ]) !!}
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Menu Name</label>
                            {!! Form::text('user_group_name',$userGroup->group_name, [ 'class' => 'form-control form--control', 'data-validation-required-message' => __('form.field_required'), 'placeholder' => __('form.edit_user_form_placeholder')]) !!}
                        </div>
                        <button type="submit" class="btn btn--base">Submit</button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
