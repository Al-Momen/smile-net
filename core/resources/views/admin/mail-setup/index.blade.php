@extends('admin.layout.master')
@section('title')
    Mail-SetUp
@endsection
@section('page-name')
    Mail-SetUp
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
                <span class="active-path g-color">Mail-SetUp</span>
           
            
        </div>
        <div class="view-prodact">
            
        </div>
    </div>
    <div class="table-content">
        <div class="shadow-lg p-4 card-1 my-3">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('success') }}!</strong> <button type="button" class="btn-close"
                        data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <!-- Button trigger modal -->
            <div>
                <div>
                    <form action="{{ route('admin.update.mail', $adminMail->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="modal-content">
                                <div class="modal-header bg--primary">
                                    <h5 class="modal-title text-white">@lang('Update Mail')</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>@lang('Mail Transport')</label>
                                        <input class="form-control form--control" type="text" name="mail_transport"
                                            placeholder="@lang('Mail Transport')" required value="{{ $adminMail->mail_transport }}">
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('Mail From')</label>
                                        <input class="form-control form--control" type="text" name="mail_from"
                                            placeholder="@lang('Mail From')" required value="{{ $adminMail->mail_from }}">
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('Mail Name')</label>
                                        <input class="form-control form--control" type="text" name="mail_username"
                                            placeholder="@lang('Mail Name')" required value="{{ $adminMail->mail_username }}">
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('Mail Password')</label>
                                        <input class="form-control form--control" type="text" name="mail_password"
                                            placeholder="@lang('Mail Password')" required value="{{ $adminMail->mail_password }}">
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('Mail Host')</label>
                                        <input class="form-control form--control" type="text" name="mail_host"
                                            placeholder="@lang('Mail Host')" required value="{{ $adminMail->mail_host }}">
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('Mail Port')</label>
                                        <input class="form-control form--control" type="text" name="mail_port"
                                            placeholder="@lang('Mail Port')" required value="{{ $adminMail->mail_port }}">
                                    </div>
                                   
                                    <div class="form-group">
                                        <label for="mail-encryption" class="form-label">@lang('Mail-Encryption')</label>
                                        <select class="form-select form-select-md mb-3 "
                                            style="padding: 12px 10px;" aria-label=".form-select-lg example" name="mail_encryption">
                                                <option @if ($adminMail->mail_encryption == 'ssl') selected  @endif
                                                value="ssl"> ssl</option>
                                                <option @if ($adminMail->mail_encryption == 'tls') selected  @endif
                                                value="tls"> tls</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection



