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
        <div class="view-prodact">
            <a href="{{ route('admin.admin-user.new') }}">
                <i class="las la-plus align-middle me-1"></i>
                <span>Create Admin User</span>
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
                                <th>Sl.</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Designation</th>
                                <th>Email</th>
                                <th>Mobile no</th>
                                <th>Group</th>
                                <th>Role</th>
                                <th>Can login</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rows as $row)

                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>
                                        <img align="middle" width="50" height="50" src="{{ $row->profile_pic_url }}"
                                            alt="No image">
                                    </td>
                                    <td>{{ $row->first_name }} {{ $row->middle_name }} {{ $row->last_name }}</td>
                                    <td>{{ $row->username }}</td>
                                    <td>{{ $row->designation }}</td>
                                    <td>{{ $row->email }}</td>
                                    <td>{{ $row->mobile_no }}</td>
                                    <td>{{ $row->group_name }}</td>
                                    <td>{{ $row->role_name }}</td>
                                    @if ($row->can_login == 0)
                                        <td class="text-center"><i class='ft-crosshair text-danger'></i>
                                        </td>
                                    @else
                                        <td class="text-center"><i class='ft-check text-success'></i></td>
                                    @endif
                                    <td>
                                        @if ($row->status == 0)
                                            {{ 'Inactive' }}
                                        @else
                                            {{ 'Active' }}
                                        @endif
                                    </td>
                                    <td>
                                        @if (hasAccessAbility('edit_admin_user', $roles))
                                            <a href="{{ route('admin.admin-user.edit', $row->id ) }}">
                                                <button type="button" class="btn btn-sm btn-outline-primary mr-1"><i
                                                        class="la la-edit"></i>
                                                </button>
                                            </a>
                                        @endif
                                        @if (hasAccessAbility('delete_admin_user', $roles))
                                            <a href="{{ route('admin.admin-user.delete', $row->id ) }}">
                                                <button type="button" class="btn btn-sm btn-outline-danger mr-1"><i
                                                        class="la la-trash"></i>
                                                </button>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
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
