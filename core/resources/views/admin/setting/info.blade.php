@extends('admin.layout.master')
@section('title')
    System Information
@endsection
@section('page-name')
    System Information Page
@endsection
@php
$roles = userRolePermissionArray();
@endphp
@section('content')
<div class="dashboard-title-part">
    <h5 class="title">Dashboard</h5>
    <div href="" class="dashboard-path">
        <a href={{ route('admin.dashboard') }}>
            <span class="main-path">Dashboard</span>
        </a>
        <i class="las la-angle-right"></i>
        <a href="{{ route('admin.admin-user') }}">
            <span class="active-path g-color">System Information</span>
        </a>
    </div>
    <div class="view-prodact">
        <a href="{{ route('admin.permission-group.new') }}">
            <i class="las la-plus align-middle me-1"></i>
            <span>System Information</span>
        </a>
    </div>
</div>
    <div class="row mb-none-30">
        <div class="col-lg-12 col-md-12 mb-30">
            <div class="table-area">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-wrapper table-responsive">
                            <table class="custom-table">
                                <tbody>
                                    <tr>
                                        <td>@lang('PHP Version')</td>
                                        <td>{{ $currentPHP }}</td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Laravel Version')</td>
                                        <td>{{ $laravelVersion }}</td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Server Software')</td>
                                        <td>{{ @$serverDetails['SERVER_SOFTWARE'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Server IP Address')</td>
                                        <td>{{ @$serverDetails['SERVER_ADDR'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Server Protocol')</td>
                                        <td>{{ @$serverDetails['SERVER_PROTOCOL'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>@lang('HTTP Host')</td>
                                        <td>{{ @$serverDetails['HTTP_HOST'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Database Port')</td>
                                        <td>{{ @$serverDetails['DB_PORT'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>@lang('App Environment')</td>
                                        <td>{{ @$serverDetails['APP_ENV'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>@lang('App Debug')</td>
                                        <td>{{ @$serverDetails['APP_DEBUG'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Timezone')</td>
                                        <td>{{ @$timeZone }}</td>
                                    </tr>
                                  </tbody>
                              </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


