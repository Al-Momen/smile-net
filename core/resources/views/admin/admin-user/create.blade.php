@extends('admin.layout.master')
@section('Dashboard', 'active')
@section('Dashboard', 'open')
@section('title')
    @lang('admin_action.list_page_title')
@endsection
@section('page-name')
    @lang('admin_action.list_page_sub_title')
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
            <a href="{{ route('admin.admin-user') }}">
                <span class="active-path g-color">Admin Users</span>
            </a>
        </div>
    </div>
    <!-- body-wrapper-start -->
    <div class="user-detail-area">
        <div class="user-info-header two">
            <h5 class="title">Create Admin User</h5>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="dashboard-form-area two mt-10">
                    <form method="POST" action="{{ route('admin.admin-user.store') }}" enctype="multipart/form-data" class="dashboard-form">
                        @csrf
                        <div class="row mb-30-none">
                            <div class="col-lg-12 mb-30">
                                <div class="row justify-content-center mb-10-none">
                                    <div class="col-lg-6 form-group">
                                        <label>First name*</label>
                                        <input type="text" name="first_name" class="form--control" placeholder="First name">
                                    </div>
                                    <div class="col-lg-6 form-group">
                                        <label>Last name*</label>
                                        <input type="text" name="last_name" class="form--control" placeholder="Last name">
                                    </div>
                                    <div class="col-lg-6 form-group">
                                        <label>Designation*</label>
                                        <input type="text" name="designation" class="form--control" placeholder="Designation">
                                    </div>
                                    <div class="col-lg-6 form-group">
                                        <label>Status*</label>
                                        <select class="form-control form--control" name="status">
                                            <option value="1">
                                                Yes
                                            </option>
                                            <option value="0">
                                                No
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6 form-group">
                                        <label>Username*</label>
                                        <input type="text" name="username" class="form-control form--control" placeholder="Username">
                                    </div>
                                    <div class="col-lg-6 form-group">
                                        <label>Email*</label>
                                        <input type="text" name="email" class="form-control form--control" placeholder="Enter valid email">
                                    </div>
                                    <div class="col-lg-4 form-group">
                                        <label>Phone No*</label>
                                        <input type="text" name="mobile_no" class="form-control form--control" placeholder="Phone No">
                                    </div>
                                    <div class="col-lg-4 form-group">
                                        <label>Password*</label>
                                        <input type="password" name="password" class="form-control form--control" placeholder="Password">
                                    </div>
                                    <div class="col-lg-4 form-group">
                                        <label>Confirm password*</label>
                                        <input type="password" name="password_confirmation" class="form-control form--control"
                                            placeholder="Password confirmation">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label>Can login*</label>
                                        <select class="form-control form--control" name="can_login">
                                            <option selected="selected" value="">Select who can login</option>
                                            <option value="1">
                                                Yes
                                            </option>
                                            <option value="0">
                                                No
                                            </option>
                                        </select>
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label>Gender*</label>
                                        <select class="form-control form--control" name="gender">
                                            <option selected="selected" value="">Select</option>
                                            <option value="1">
                                                Male
                                            </option>
                                            <option value="0">
                                                Female
                                            </option>

                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Photo*</label>
                                        <input type="file" name="profile_pic">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pro-btn-area mt-30">
                            <button type="submit" class="btn btn--base w-100">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
