@extends('admin.layout.master')
@section('role', 'active')
@section('Role Management', 'open')
@section('title')
    Role
@endsection
@section('page-name')
    Role Management
@endsection
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
            <span class="active-path g-color">New Role</span>
        </div>
        <h5 class="title">New Role</h5>
    </div>
    <!-- body-wrapper-start -->
    <div class="dashboard-form-area">
        {!! Form::open(['route' => 'admin.role.store', 'method' => 'post']) !!}
        @csrf
        <div class="row">
            <div class="col-md-7">
                <div class="form-group">
                    <label for="roles">Role</label>
                    <input class="form-control form--control" placeholder="Enter role name" name="role_name" type="text">
                </div>
            </div>
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-wrapper table-responsive">
                            <table class="custom-table">
                                <thead class="text-center">
                                    <tr>
                                        <th>Menu</th>
                                        <th colspan="3">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            Permission group
                                        </td>
                                        <td>
                                            <label class="m-checkbox">
                                                <input name="permission[]" type="checkbox" value="view_permission_group">
                                                <span></span>
                                            </label>
                                        </td>
                                        <td <label class="m-checkbox">
                                            <input name="permission[]" type="checkbox" value="add_permission_group">
                                            <span></span>
                                            </label>
                                        </td>
                                        <td>

                                            <label class="m-checkbox">
                                                <input name="permission[]" type="checkbox" value="edit_permission_group">
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>

                                            <label class="m-checkbox">
                                                <input name="permission[]" type="checkbox" value="delete_permission_group">
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>

                                            <label class="m-checkbox">
                                                <input name="permission[]" type="checkbox" value="execute_permission_group">
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Permission
                                        </td>
                                        <td style="vertical-align: middle">

                                            <label class="m-checkbox">
                                                <input name="permission[]" type="checkbox" value="view_permission">
                                                <span></span>
                                            </label>
                                        </td>
                                        <td style="vertical-align: middle">

                                            <label class="m-checkbox">
                                                <input name="permission[]" type="checkbox" value="add_permission">
                                                <span></span>
                                            </label>
                                        </td>
                                        <td style="vertical-align: middle">

                                            <label class="m-checkbox">
                                                <input name="permission[]" type="checkbox" value="edit_permission">
                                                <span></span>
                                            </label>
                                        </td>
                                        <td style="vertical-align: middle">

                                            <label class="m-checkbox">
                                                <input name="permission[]" type="checkbox" value="delete_permission">
                                                <span></span>
                                            </label>
                                        </td>
                                        <td style="vertical-align: middle">

                                            <label class="m-checkbox">
                                                <input name="permission[]" type="checkbox"
                                                    value="execute_delete_permission">
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            User role
                                        </td>
                                        <td style="vertical-align: middle">

                                            <label class="m-checkbox">
                                                <input name="permission[]" type="checkbox" value="view_role">
                                                <span></span>
                                            </label>
                                        </td>
                                        <td style="vertical-align: middle">

                                            <label class="m-checkbox">
                                                <input name="permission[]" type="checkbox" value="add_role">
                                                <span></span>
                                            </label>
                                        </td>
                                        <td style="vertical-align: middle">

                                            <label class="m-checkbox">
                                                <input name="permission[]" type="checkbox" value="edit_role">
                                                <span></span>
                                            </label>
                                        </td>
                                        <td style="vertical-align: middle">

                                            <label class="m-checkbox">
                                                <input name="permission[]" type="checkbox" value="delete_role">
                                                <span></span>
                                            </label>
                                        </td>
                                        <td style="vertical-align: middle">

                                            <label class="m-checkbox">
                                                <input name="permission[]" type="checkbox" value="execute_role">
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Dashboard
                                        </td>
                                        <td style="vertical-align: middle">

                                            <label class="m-checkbox">
                                                <input name="permission[]" type="checkbox" value="view_dashboard">
                                                <span></span>
                                            </label>
                                        </td>
                                        <td style="vertical-align: middle">
                                            --
                                        </td>
                                        <td style="vertical-align: middle">
                                            --
                                        </td>
                                        <td style="vertical-align: middle">
                                            --
                                        </td>
                                        <td style="vertical-align: middle">

                                            <label class="m-checkbox">
                                                <input name="permission[]" type="checkbox" value="execute_dashboard">
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Admin User
                                        </td>
                                        <td style="vertical-align: middle">

                                            <label class="m-checkbox">
                                                <input name="permission[]" type="checkbox" value="view_admin_user">
                                                <span></span>
                                            </label>
                                        </td>
                                        <td style="vertical-align: middle">

                                            <label class="m-checkbox">
                                                <input name="permission[]" type="checkbox" value="add_admin_user">
                                                <span></span>
                                            </label>
                                        </td>
                                        <td style="vertical-align: middle">

                                            <label class="m-checkbox">
                                                <input name="permission[]" type="checkbox" value="edit_admin_user">
                                                <span></span>
                                            </label>
                                        </td>
                                        <td style="vertical-align: middle">

                                            <label class="m-checkbox">
                                                <input name="permission[]" type="checkbox" value="delete_admin_user">
                                                <span></span>
                                            </label>
                                        </td>
                                        <td style="vertical-align: middle">

                                            <label class="m-checkbox">
                                                <input name="permission[]" type="checkbox" value="execute_admin_user">
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>
                                        </td>
                                    </tr>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div>
        </div>
        <button class="btn btn--base">Save</button>
        <button class="btn btn--base bg--danger">Cancel</button>

        {!! Form::close() !!}
    </div>
@endsection
