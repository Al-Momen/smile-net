@extends('admin.layout.master')
@section('permission','active')
@section('Role Management','open')
@section('title')
    @lang('admin_action.edit_page_title')
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card" style="height: 981.5px;">
            <div class="card-header">
                <h4 class="card-title" id="basic-layout-colored-form-control">@lang('form.edit_action_form_title')</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="card-content collapse show">
                <div class="card-body">
                    {!! Form::open([ 'route' => [ 'admin.permission.update', $permission->id], 'method' => 'post', 'class' => 'form-horizontal', 'files' => true , 'novalidate']) !!}
                    @csrf
                    <div class="form-body">
                        <div class="col-md-6 offset-3">
                            <div class="form-group">
                                <label>@lang('form.new_action_form_field_menuslug')</label>
                                <div class="controls">
                                    {!! Form::text('permission_slug', $permission->name, [ 'class' => 'form-control mb-1', 'data-validation-required-message' => __('form.field_required'), 'placeholder' => __('form.new_action_form_placeholder_menuslug'), 'tabindex' => 1 ]) !!}
                                </div>
                                @if ($errors->has('permission_slug'))
                                    <div class="alert alert-danger">
                                        <strong>{{ $errors->first('permission_slug') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6 offset-3">
                            <div class="form-group">
                                <label>Display Name</label>
                                <div class="controls">
                                    {!! Form::text('display_name', $permission->display_name, [ 'class' => 'form-control mb-1', 'data-validation-required-message' => __('form.field_required'), 'placeholder' => __('form.new_action_form_placeholder_name'), 'tabindex' => 2 ]) !!}
                                </div>
                                @if ($errors->has('display_name'))
                                    <div class="alert alert-danger">
                                        <strong>{{ $errors->first('display_name') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6 offset-3">
                            <div class="form-group">
                                <label>Permission Group</label>
                                <div class="controls">
                                    {!! Form::select('permission_group', $group, $permission->permission_group_id, [ 'class' => 'form-control mb-1', 'placeholder' => __('form.new_action_form_placeholder_menu'), 'data-validation-required-message' => __('form.field_required')]) !!}
                                </div>
                                @if ($errors->has('permission_group'))
                                    <div class="alert alert-danger">
                                        <strong>{{ $errors->first('permission_group') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-actions text-center">
                            <a href="{{ route('admin.permission.index') }} ">
                                <button type="button" class="btn btn-warning mr-1">
                                    <i class="ft-x"></i> @lang('form.btn_cancle')
                                </button>
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="la la-check-square-o"></i> @lang('form.btn_edit')
                            </button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
