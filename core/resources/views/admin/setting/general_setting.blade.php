@extends('admin.layout.master')
@section('title')
    General Settings
@endsection
@section('page-name')
    General Settings Page
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
                <span class="active-path g-color">Site Setting</span>
            </a>
        </div>
        <div class="view-prodact">
            <a href="{{ route('admin.permission-group.new') }}">
                {{-- <i class="las la-plus align-middle me-1"></i>
            <span>New Permission Group</span> --}}
            </a>
        </div>
    </div>

    <div class="user-detail-area">
        <div class="user-info-header two">
            <h5 class="title">Site Settings</h5>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="dashboard-form-area two mt-10">
                    <form class="dashboard-form" action="{{ route('admin.setting.update') }}" method="POST">
                        @csrf

                        <div class="site-color-area mb-4">
                            <div class="row justify-content-center">
                                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12 form-group">
                                    {{-- <div class="site-color-wrapper colorPicker"></div> --}}
                                    <label>Site Base Color</label>
                                    <input type="color" class="form--control colorCode" name="base_color"
                                        value="{{ $general->base_color ?? '' }}">
                                </div>

                                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12 form-group">
                                    {{-- <div class="site-color-wrapper secondary"></div> --}}
                                    <label>Site Secondary Color</label>
                                    <input type="color" class="form--control" name="secondary_color"
                                        value="{{ $general->secondary_color ?? '' }}">

                                </div>
                                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12 form-group">
                                    {{-- <div class="site-color-wrapper component"></div> --}}
                                    <label>Component Color</label>
                                    <input type="color" class="form--control" name='component_color'
                                        value="{{ $general->component_color ?? '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="dashboard-form">
                            <div class="row justify-content-center mb-10-none ps-3 pe-3">
                                <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 col-sm-6 form-group">
                                    <label>Site Title</label>
                                    <input type="text" name="sitename" class="form--control" placeholder="0"
                                        value="{{ $general->sitename ?? '' }}">
                                </div>
                                <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 col-sm-6 form-group">
                                    <label>Site subtitle</label>
                                    <input type="text" name="site_sub_title" class="form--control" placeholder="0"
                                        value="{{ $general->site_sub_title ?? '' }}">
                                </div>
                                <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 col-sm-6 form-group">
                                    {{-- @dd($general->timezone) --}}
                                    <label>OTP Expiration</label>
                                    <div class="input-group">
                                        <input type="number" name="otp_expiration" class="form--control"
                                            placeholder="0"value="{{ $general->otp_expiration ?? '' }}">
                                        <div class="input-group-append">
                                            <span class="input-group-text copytext">
                                                Seconds
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-xl-12 col-lg-12 col-md-6 col-sm-6 form-group">
                                    <label>Timezone</label>

                                    <select class="form--control" name='timezone'>
                                        @foreach ($timezones as $timezone)
                                            <option value="{{ @$timezone }}"
                                                @if ($general->timezone == $timezone) selected @endif>{{ $timezone }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row text-center pt-30 mb-10-none">
                                {{-- <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-4 col-sm-6 form-group">
                                    <label>User Registration</label>
                                    <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success"
                                        data-offstyle="-danger" data-toggle="toggle" data-on="Activated"
                                        data-off="Deactivated" name="registration"
                                        @if ($general->registration) checked @endif>
                                </div> --}}
                                {{-- <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-4 col-sm-6 form-group">
                                    <label>Secure Password</label>
                                    <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success"
                                        data-offstyle="-danger" data-toggle="toggle" data-on="Activated"
                                        data-off="Deactivated" name="secure_password"
                                        @if ($general->secure_password) checked @endif>
                                </div> --}}
                                {{-- <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-4 col-sm-6 form-group">
                                    <label>Agree Policy</label>
                                    <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success"
                                        data-offstyle="-danger" data-toggle="toggle" data-on="Activated"
                                        data-off="Deactivated" name="agree"
                                        @if ($general->agree) checked @endif>
                                </div> --}}
                                {{-- <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-4 col-sm-6 form-group">
                                    <label>Force SSL</label>
                                    <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success"
                                        data-offstyle="-danger" data-toggle="toggle" data-on="Activated"
                                        data-off="Deactivated" name="force_ssl"
                                        @if ($general->force_ssl) checked @endif>
                                </div> --}}
                                {{-- <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-6 form-group">
                                    <label>Email Verification</label>
                                    <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success"
                                        data-offstyle="-danger" data-toggle="toggle" data-on="Activated"
                                        data-off="Deactivated" name="ev"
                                        @if ($general->ev) checked @endif>
                                </div> --}}
                                {{-- <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-6 form-group">
                                    <label>Email Notification</label>
                                    <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success"
                                        data-offstyle="-danger" data-toggle="toggle" data-on="Activated"
                                        data-off="Deactivated" name="en"
                                        @if ($general->en) checked @endif>
                                </div> --}}
                                {{-- <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-4 col-sm-6 form-group">
                                    <label>SMS Verification</label>
                                    <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success"
                                        data-offstyle="-danger" data-toggle="toggle" data-on="Activated"
                                        data-off="Deactivated" name="sv"
                                        @if ($general->sv) checked @endif>
                                </div> --}}
                                {{-- <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-4 col-sm-6 form-group">
                                    <label>SMS Notification</label>
                                    <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success"
                                        data-offstyle="-danger" data-toggle="toggle" data-on="Activated"
                                        data-off="Deactivated" name="sn"
                                        @if ($general->sn) checked @endif>
                                </div> --}}
                                {{-- <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-4 col-sm-6 form-group">
                                    <label>Deposit</label>
                                    <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success"
                                        data-offstyle="-danger" data-toggle="toggle" data-on="Activated"
                                        data-off="Deactivated" name="deposit_status"
                                        @if ($general->deposit_status) checked @endif>
                                </div> --}}
                                {{-- <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-6 form-group">
                                    <label>Withdraw</label>
                                    <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success"
                                        data-offstyle="-danger" data-toggle="toggle" data-on="Activated"
                                        data-off="Deactivated" name="withdraw_status"
                                        @if ($general->withdraw_status) checked @endif>
                                </div> --}}
                                {{-- <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-4 col-sm-6 form-group">
                                    <label>KYC Verification</label>
                                    <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success"
                                        data-offstyle="-danger" data-toggle="toggle" data-on="Activated"
                                        data-off="Deactivated" name="kyc_verification"
                                        @if ($general->kyc_verification) checked @endif>
                                </div> --}}
                                {{-- <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-4 col-sm-6 form-group">
                                    <label>Dark Theme</label>
                                    <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success"
                                        data-offstyle="-danger" data-toggle="toggle" data-on="Activated"
                                        data-off="Deactivated" name="dark"
                                        @if ($general->dark) checked @endif>
                                </div> --}}
                                {{-- <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-4 col-sm-6 form-group">
                                    <label>Devlopment Mode</label>
                                    <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success"
                                        data-offstyle="-danger" data-toggle="toggle" data-on="Activated"
                                        data-off="Deactivated" name="devlopment_mode"
                                        @if ($general->devlopment_mode) checked @endif>
                                </div> --}}
                            </div>
                        </div>
                        <div class="info-two-btn mt-30">
                            <button type="submit" class="btn btn--base w-100"><i class="las la-cloud-upload-alt"></i>
                                Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        (function($) {
            "use strict";
            $('.colorPicker').spectrum({
                color: $(this).data('color'),
                change: function(color) {
                    $(this).parent().siblings('.colorCode').val(color.toHexString().replace(/^#?/, ''));
                }
            });
            $('.colorCode').on('input', function() {
                var clr = $(this).val();
                $(this).parents('.input-group').find('.colorPicker').spectrum({
                    color: clr,
                });
            });
            $('.select2-basic').select2({
                dropdownParent: $('.card-body')
            });
            $('select[name=timezone]').val();
        })(jQuery);
    </script>
@endsection
