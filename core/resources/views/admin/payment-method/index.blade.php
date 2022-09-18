@extends('admin.layout.master')
@section('role', 'active')
@section('Manage Payment Gateway', 'open')
@section('title')
    @lang('admin_role.list_page_title')
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('admin_role.breadcrumb_title') </a>
    </li>
    <li class="breadcrumb-item active">@lang('admin_role.breadcrumb_sub_title')
    </li>
@endsection
@php
$roles = userRolePermissionArray();
@endphp
@section('content')
    <div class="dashboard-title-part">
        <div class="view-prodact">
            <a href="#">
                <i class="las la-arrow-left align-middle me-1"></i>
                <span>Go Back</span>
            </a>
        </div>
        <div class="dashboard-path">
            <span class="main-path">Dashboards</span>
            <i class="las la-angle-right"></i>
            <span class="active-path g-color">Roles</span>
        </div>
        <div class="view-prodact">
            <a href="{{ route('admin.role.new') }}">
                <i class="las la-plus align-middle me-1"></i>
                <span>New Role</span>
            </a>
        </div>
    </div>
    <!-- body-wrapper-start -->
    <div class="table-area">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-wrapper table-responsive">
                    <table class="custom-table">
                        <thead>
                            <tr class="custom-table-row">
                                <th>Gateway</th>
                                <th>Supported Currency</th>
                                <th>Enabled Currency	</th>
                                <th>Status</th>
                                <th>@lang('tablehead.tbl_head_action')</th>
                            </tr>
                        </thead>
                        <tbody>

                                <tr>
                                    <td>a</td>
                                    <td>a</td>
                                    <td>a</td>
                                    <td>a</td>
                                    <td>a</td>
                                    <td>a</td>
                                    <td>a</td>
                                </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <nav>
            <ul class="pagination">
                <li class="page-item disabled" aria-disabled="true" aria-label="« Previous">
                    <span class="page-link" aria-hidden="true">‹</span>
                </li>
                <li class="page-item active" aria-current="page"><span class="page-link">1</span></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">4</a></li>
                <li class="page-item">
                    <a class="page-link" href="#" rel="next" aria-label="Next »">›</a>
                </li>
            </ul>
        </nav>
    </div>
@endsection
