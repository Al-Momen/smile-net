@extends('admin.layout.master')
@section('content')
    <div class="row">
        <div class="table-area">
            <div class="row">
                <div class="col-lg-12">
                    <div class="user-info-header two">
                        <h5 class="title">Global Email Template</h5>
                    </div>
                    <div class="table-wrapper table-responsive">
                        <table class="custom-table">
                            <thead>
                            <tr>
                                <th>Short Code</th>
                                <th>Description</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>@{{full name}}</td>
                                    <td>User Full Name</td>
                                </tr>
                                <tr>
                                    <td>@{{username}}</td>
                                    <td>Username</td>
                                </tr>
                                <tr>
                                    <td>@{{message}}</td>
                                    <td>Message</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">

            <div class="user-detail-area mt-30">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="user-info-header two">
                            <h5 class="title">Email Sent From</h5>
                        </div>
                        <div class="dashboard-form-area two mt-10">
                            <form class="dashboard-form" action="{{ route('admin.email.template.global.update') }}" method="POST">
                                @csrf
                                <div class="row justify-content-center mb-10-none">
                                    <div class="col-lg-12 form-group">
                                        <input type="text" class="form--control" placeholder="@lang('Email address')" name="email_from" value="{{ $general->email_from }}" required>
                                    </div>
                                    <div class="col-lg-12 form-group">
                                        <textarea class="form--control nicEdit" name="email_template" placeholder="@lang('Your email template')">{{ $general->email_template }}</textarea>
                                    </div>
                                    <div class="col-lg-12 form-group">
                                        <button type="submit" class="btn btn--base w-100" >Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


