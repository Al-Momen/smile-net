@extends('admin.layout.master')
@section('permission', 'active')
@section('Role Management', 'open')
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
        <div class="view-prodact">
            <a href="#">
                <i class="las la-arrow-left align-middle me-1"></i>
                <span>Go Back</span>
            </a>
        </div>
        <div class="dashboard-path">
            <span class="main-path">Dashboards</span>
            <i class="las la-angle-right"></i>
            <span class="active-path g-color">Action</span>
        </div>
        <div class="view-prodact">
            <a href="{{ route('admin.permission.new') }}">
                <i class="las la-plus align-middle me-1"></i>
                <span>New Action</span>
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
                                <th>@lang('tablehead.tbl_head_sl')</th>
                                <th>@lang('tablehead.tbl_head_name')</th>
                                <th>@lang('tablehead.tbl_head_created_by')</th>
                                <th>@lang('tablehead.tbl_head_created_at')</th>
                                <th>@lang('tablehead.tbl_head_action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rows as $row)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $row->display_name }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->group->group_name }}</td>
                                    <td>{{ $row->created_at }}</td>
                                    <td>

                                        <a class="text-white" href="{{ route('admin.permission.edit', [$row->id]) }}">
                                            <button type="button" class="btn btn-sm btn-outline-primary mr-1"><i
                                                    class="la la-edit"></i>
                                            </button>
                                        </a>

                                        <a class="text-white" href="{{ route('admin.permission.delete', [$row->id]) }}"
                                            onclick="return confirm('Are you sure?')">
                                            <button type="button" class="btn btn-sm btn-outline-danger mr-1"><i
                                                    class="la la-trash"></i>
                                            </button>
                                        </a>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
