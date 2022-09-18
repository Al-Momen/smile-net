@extends('admin.layout.master')
@section('permission', 'active')
@section('Role Management', 'open')
@section('title')
    @lang('admin_action.edit_page_title')
@endsection
@section('content')
    <div class="dashboard-form-area">
        <div class="dashboard-title-part">
            <div class="view-prodact">
                <a href="#">
                    <i class="las la-arrow-left align-middle me-1"></i>
                    <span>Go Back</span>
                </a>
            </div>
            <div class="dashboard-path">
                <span class="main-path">Action</span>
                <i class="las la-angle-right"></i>
                <span class="active-path g-color">Update Action</span>
            </div>
            <div class="view-prodact">
                <a href="{{ route('admin.permission.new') }}">
                    <i class="las la-plus align-middle me-1"></i>
                    <span>New Action</span>
                </a>
            </div>
        </div>

        <div class="user-info-header two mb-20">
            <h5 class="title">User data form</h5>
        </div>

        <div class=" justify-content-center mb-10-none addedField">
            {!! Form::open([
                'route' => ['admin.permission.update', $permission->id],
                'method' => 'post',
            ]) !!}
            @csrf
            <div class="form-group ">
                <div class="input-group row user-data">
                    <div class="col-lg-4 col-md-4 form-group">
                        <label>@lang('form.new_action_form_field_menuslug')</label>
                        <div class="controls">
                            {!! Form::text('permission_slug', $permission->name, [
                                'class' => 'form-control form--control',
                                'data-validation-required-message' => __('form.field_required'),
                                'placeholder' => __('form.new_action_form_placeholder_menuslug')
                            ]) !!}
                        </div>
                        @if ($errors->has('permission_slug'))
                            <strong class="text-warning">{{ $errors->first('permission_slug') }}</strong>
                        @endif
                    </div>
                    <div class="col-lg-4 col-md-3 form-group">
                        <label>Display Name</label>
                        <div class="controls">
                            {!! Form::text('display_name', $permission->display_name, [
                                'class' => 'form-control form--control',
                                'data-validation-required-message' => __('form.field_required'),
                                'placeholder' => __('form.new_action_form_placeholder_name'),
                                'tabindex' => 2,
                            ]) !!}
                        </div>
                        @if ($errors->has('display_name'))
                            <div class="alert alert-danger">
                                <strong>{{ $errors->first('display_name') }}</strong>
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-4 col-md-3 form-group">
                        <label>Permission Group</label>
                        {!! Form::select('permission_group', $group, $permission->permission_group_id, [
                            'class' => 'form-control form--control',
                            'placeholder' => __('form.new_action_form_placeholder_menu'),
                            'data-validation-required-message' => __('form.field_required'),
                        ]) !!}
                        @if ($errors->has('permission_group'))
                            <strong class="text-warning">{{ $errors->first('permission_group') }}</strong>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                <button type="submit" class="btn--base w-100 mt-20">@lang('form.btn_edit')</button>
            </div>
            {!! Form::close() !!}
        </div>
    @endsection
