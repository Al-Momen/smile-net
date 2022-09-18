@extends('admin.layout.master')
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

    <div class="row mb-none-30">
        <div class="col-lg-12">

            <div class="user-detail-area mt-30">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="user-info-header two">
                            <h5 class="title">GDPR Cookie</h5>
                        </div>
                        <div class="dashboard-form-area two mt-10">
                            <form class="dashboard-form" action="{{ route('admin.setting.cookie.update') }}" method="post">
                                @csrf
                                <div class="row mb-10-none">
                                    <div class="col-xxl-9 col-xl-9 col-lg-9 col-md-8 col-sm-8 form-group">
                                        <label>Policy Link</label>
                                        <input type="text" name="link" class="form--control" value="{{ @$cookie->data_values->link }}" placeholder="@lang('Policy Link')">
                                    </div>

                                    <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-4 col-sm-6 form-group">
                                        <label>Status</label>
                                        <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="@lang('Enable')" data-off="@lang("Disabled")" @if(@$cookie->data_values->status) checked @endif name="status">
                                    </div>
                                    <div class="col-lg-12 form-group">
                                        <label>Description</label>
                                        <textarea class="form--control nicEdit" name="description" placeholder="Write Text Here">@php echo @$cookie->data_values->description @endphp</textarea>
                                    </div>
                                    <div class="col-lg-12 form-group">
                                        <button type="submit" class="btn btn--base w-100">Submit</button>
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
