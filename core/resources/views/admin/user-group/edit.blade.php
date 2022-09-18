@extends('admin.layout.master')
@section('User Management', 'open')
@section('title')
Edit User Group
@endsection
@section('page-name')
    @lang('user_group.list_page_sub_title')
@endsection
@section('content')
    <div class="dashboard-title-part">
        <div class="view-prodact">
            <a href="#">
                <i class="las la-arrow-left align-middle me-1"></i>
                <span>Go Back</span>
            </a>
        </div>
        <div class="dashboard-path">
            <span class="main-path">Dashboard</span>
            <i class="las la-angle-right"></i>
            <span class="active-path g-color">User group</span>
        </div>
        <div class="view-prodact">
            <a href="{{ route('admin.user-group.new') }}">
                <i class="las la-plus align-middle me-1"></i>
                <span>New User Group</span>
            </a>
        </div>
    </div>
    <div class="dashboard-form-area">
        {!! Form::open(['route' => ['admin.user-group.update', $userGroup->id],'method' => 'post']) !!}
        @csrf
        <div class="form-body">
            <div class="col-md-6 offset-3">
                    <label>Edit User Group</label>
                        {!! Form::text('user_group_name', $userGroup->group_name, [
                            'class' => 'form-control form--control',
                            'data-validation-required-message' => __('form.field_required'),
                            'placeholder' => __('form.edit_user_form_placeholder')
                        ]) !!}

                    @if ($errors->has('user_group_name'))
                        <div class="alert alert-danger">
                            <strong>{{ $errors->first('user_group_name') }}</strong>
                        </div>
                    @endif

            </div>
            <div class="col-md-6 offset-3">
                <div class="form-group">
                    <label>@lang('form.new_group_form_filed_role')</label>
                        {!! Form::select('role', $role, $userGroup->role_id, [
                            'class' => 'form-control form--control',
                            'placeholder' => 'Select role name',
                            'data-validation-required-message' => __('form.field_required'),
                        ]) !!}
                    @if ($errors->has('role'))
                        <span class="alert alert-danger">
                            <strong class="text-danger">{{ $errors->first('role') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-actions text-center mt-3">
                <a href="{{ route('admin.permission-group') }}">
                    <button type="button" class="btn btn--base bg--danger">
                        <i class="ft-x"></i> @lang('form.btn_cancle')
                    </button>
                </a>
                <button type="submit" class="btn btn--base">
                    <i class="la la-check-square-o"></i> @lang('form.btn_save')
                </button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
