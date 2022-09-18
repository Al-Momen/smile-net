@extends('admin.layout.master')
@section('role','active')
@section('Role Management','open')
@section('title')
    @lang('admin_role.edit_page_title')
@endsection
@section('page-name')
    @lang('admin_role.list_page_sub_title')
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{url('/admin.admin-user')}}">@lang('admin_role.edit_page_breadcrumb_title_1')</a>
    </li>
    <li class="breadcrumb-item"><a href="{{ route('admin.role') }}">@lang('admin_role.edit_page_breadcrumb_title_2')</a>
    </li>
    <li class="breadcrumb-item active">@lang('admin_role.edit_page_breadcrumb_title_active')
    </li>
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card" style="height: 582.5px;">
            <div class="card-header">
                <h4 class="card-title" id="basic-layout-colored-form-control">User Profile</h4>
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
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div>{{$error}}</div>
                        @endforeach
                    @endif
                    {!! Form::open([ 'route' => ['admin.role.update', $role->id] , 'method' => 'post', 'class' => 'form-horizontal', 'files' => true , 'novalidate']) !!}
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Role Name :</strong></label>
                                    <div class="controls">
                                        {!! Form::text('role_name',$role->role_name, [ 'class' => 'form-control', 'data-validation-required-message' => 'This field is required', 'placeholder' => 'Enter group name', 'tabindex' => 1 ]) !!}
                                    </div>
                                    @if ($errors->has('role_name'))
                                        <div class="alert alert-danger">
                                            <strong>{{ $errors->first('role_name') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @php
                        $assigned_perms = explode(",",$role->permission->permissions);
                    @endphp
                    <div class="table-responsive">

                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
