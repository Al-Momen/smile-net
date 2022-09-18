@extends('admin.layout.master')
@section('admin-user', 'active')
@section('title')
    Roles Menus
@endsection
@section('page-name')
Roles Menus
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
        <div class="view-prodact">
            <a href="{{ route('admin.permission-group.new') }}">
                <i class="las la-plus align-middle me-1"></i>
                <span>New Permission Group</span>
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
                            <tr>
                                <th>@lang('tablehead.tbl_head_sl')</th>
                                <th>@lang('tablehead.tbl_head_name')</th>
                                <th>@lang('tablehead.tbl_head_created_at')</th>
                                <th>@lang('tablehead.tbl_head_action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rows as $row)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $row->group_name }}</td>
                                    <td>{{ $row->created_at }}</td>
                                    <td>
                                        @if (hasAccessAbility('edit_menu', $roles))
                                            <a class="text-white"
                                                href="{{ route('admin.permission-group.edit', [$row->id]) }}">
                                                <button type="button" class="btn btn-sm btn-outline-primary mr-1"><i
                                                        class="la la-edit"></i>
                                                </button>
                                            </a>
                                        @endif
                                        @if (hasAccessAbility('delete_menu', $roles))
                                            <a class="text-white"
                                                href="{{ route('admin.permission-group.delete', [$row->id]) }}">
                                                <button type="button" class="btn btn-sm btn-outline-danger mr-1"><i
                                                        class="la la-trash"></i>
                                                </button>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach()
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
