@extends('admin.layout.master')
@section('permission-group', 'active')
@section('Role Management', 'open')
@section('title')
    @lang('admin_menu.new_page_title')
@endsection
@section('page-name')
    @lang('admin_menu.new_page_sub_title')
@endsection
@section('content')

    <div class="table-area">
        <div class="row">
            <div class="col-lg-12">
                <div class="dashboard-form-area">
                    <div class="card-header">
                        New Menu
                    </div>
                    <div class="card-body">
                        {!! Form::open(['route' => ['admin.permission-group.store'], 'method' => 'post']) !!}
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Menu Name</label>
                            {!! Form::text('permission_group_name', null, [
                                'class' => 'form-control form--control',
                                'data-validation-required-message' => __('form.field_required'),
                                'placeholder' => __('form.new_menu_form_placeholder')
                            ]) !!}
                        </div>
                        @if ($errors->has('permission_group_name'))
                            <strong>{{ $errors->first('permission_group_name') }}</strong> <br>
                        @endif
                        <button type="submit" class="btn btn--base">@lang('form.btn_save') </button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>


@endsection
