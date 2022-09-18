@extends('admin.layout.master')
@section('admin-user', 'active')
@section('title')
    Admin | Edit
@endsection
@section('page-name')
    Edit Admin User
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
            <div class="col-md-12">
                @if ($errors->all())
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                @endif
                <div class="dashboard-form-area">
                    <div class="card-body">
                        {!! Form::open(['route' => ['admin.admin-user.update', $user->auth_id], 'method' => 'post', 'files' => true]) !!}
                        @csrf
                        <div class="form-body">
                            <h4 class="form-section"></i>User Information</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <div class="controls">
                                            {!! Form::text('first_name', $user->first_name, [
                                                'class' => 'form-control form--control',
                                                'data-validation-required-message' => 'This field is required',
                                                'placeholder' => 'Enter first name',
                                            ]) !!}
                                        </div>
                                        @if ($errors->has('first_name'))
                                            <span class="alert alert-danger">
                                                <strong>{{ $errors->first('first_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <div class="controls">
                                            {!! Form::text('last_name', $user->last_name, [
                                                'class' => 'form-control form--control',
                                                'data-validation-required-message' => 'This field is required',
                                                'placeholder' => 'Enter last name',
                                            ]) !!}
                                        </div>
                                    </div>
                                    @if ($errors->has('last_name'))
                                        <span class="alert alert-danger">
                                            <strong>{{ $errors->first('last_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Designation</label>
                                        <div class="controls">
                                            {!! Form::text('designation', $user->designation, [
                                                'class' => 'form-control form--control',
                                                'data-validation-required-message' => 'This field is required',
                                                'placeholder' => 'Enter designation',
                                            ]) !!}
                                        </div>
                                    </div>
                                    @if ($errors->has('designation'))
                                        <span class="alert alert-danger">
                                            <strong>{{ $errors->first('designation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <div class="controls">
                                            {!! Form::select('status', ['1' => 'Yes', '0' => 'No'], $user->status, [
                                                'class' => 'form-control form--control',
                                                'placeholder' => 'Select status',
                                                'data-validation-required-message' => 'This field is required',
                                            ]) !!}
                                        </div>
                                        @if ($errors->has('status'))
                                            <div class="alert alert-danger">
                                                <strong>{{ $errors->first('status') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h4 class="form-section"><i class="ft-mail"></i> Contact Info &amp; Bio</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Username</label>
                                    <div class="controls">
                                        {!! Form::text('username', $user->username, [
                                            'class' => 'form-control form--control',
                                            'data-validation-required-message' => 'This field is required',
                                            'placeholder' => 'Enter username',
                                        ]) !!}
                                    </div>
                                    @if ($errors->has('username'))
                                        <span class="alert alert-danger">
                                            <strong>{{ $errors->first('username') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Contact Number</label>
                                    <div class="controls">
                                        {!! Form::text('mobile_no', $user->mobile_no, [
                                            'class' => 'form-control form--control',
                                            'data-validation-required-message' => 'This field is required',
                                            'placeholder' => 'Enter contact number',
                                        ]) !!}
                                    </div>
                                    @if ($errors->has('mobile_no'))
                                        <span class="alert alert-danger">
                                            <strong>{{ $errors->first('mobile_no') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <div class="controls">
                                {!! Form::text('email', $user->email, [
                                    'class' => 'form-control form--control',
                                    'data-validation-required-message' => 'This field is required',
                                    'placeholder' => 'Enter email',
                                ]) !!}
                            </div>
                            @if ($errors->has('email'))
                                <span class="alert alert-danger">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Gender</label>
                                    <div class="controls">
                                        {!! Form::select('gender', ['1' => 'Male', '0' => 'Female'], $user->gender, [
                                            'class' => 'form-control form--control',
                                            'placeholder' => 'Select gender',
                                            'data-validation-required-message' => 'This field is required',
                                        ]) !!}
                                    </div>
                                    @if ($errors->has('gender'))
                                        <span class="alert alert-danger">
                                            <strong>{{ $errors->first('gender') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Can Login</label>
                                    <div class="controls">
                                        {!! Form::select('can_login', ['1' => 'Yes', '0' => 'No'], $user->can_login, [
                                            'class' => 'form-control form--control',
                                            'placeholder' => 'Select who can login',
                                            'data-validation-required-message' => 'This field is required',
                                        ]) !!}
                                    </div>
                                    @if ($errors->has('can_login'))
                                        <span class="alert alert-danger">
                                            <strong>{{ $errors->first('can_login') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('form.admin_user_form_field_group_name')</label>
                                    <div class="controls">
                                        {!! Form::select('user_group', $userGroup, $user->user_group_id, [
                                            'class' => 'form-control form--control',
                                            'placeholder' => 'Select Group name',
                                        ]) !!}
                                    </div>
                                    @if ($errors->has('user_group'))
                                        <span class="alert alert-danger">
                                            <strong>{{ $errors->first('user_group') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('form.profile_pic')</label>

                                    {!! Form::file('profile_pic', ['class' => 'form-control form--control']) !!}

                                    @if ($errors->has('profile_pic'))
                                        <div class="alert alert-danger">
                                            <strong>{{ $errors->first('profile_pic') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn--base">
                            Save
                        </button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
