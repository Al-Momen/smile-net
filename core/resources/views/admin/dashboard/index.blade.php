@extends('admin.layout.master')
@section('Dashboard', 'active')
@section('Dashboard', 'open')
@section('title')
    @lang('admin_action.list_page_title')
@endsection
@section('page-name')
    @lang('admin_action.list_page_sub_title')
@endsection
@section('content')
<div class="dashboard-title-part">
    <h5 class="title">Dashboard</h5>
    <a href="{{ route('admin.dashboard') }}" class="dashboard-path">
        <span class="main-path">Dashboards</span>
        <i class="las la-angle-right"></i>
        <span class="active-path g-color">Dashboard</span>
    </a>
    <div class="view-prodact">
        <a href="#">
            <i class="las la-eye align-middle me-1"></i>
            <span>View Product</span>
        </a>
    </div>
</div>
<!-- body-wrapper-start -->
<div class="dashboard-area">
    <div class="dashboard-item-area">
        <div class="row justify-content-center mb-30-none">
            <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-30">
                <div class="dashbord-user style-two">
                    <div class="dashboard-content">
                        <div class="title">
                            <span>Total Users</span>
                        </div>
                        <div class="user-count d-flex">
                            <span>155</span>
                        </div>
                        <div class="view-all-btn">
                            <a href="#0">View All</a>
                        </div>
                    </div>
                    <div class="dashboard-icon-area">
                        <div class="user-last">
                            <p>Last week <span class="g-color">+233</span></p>
                        </div>
                        <div class="dashboard-icon base-color">
                            <i class="las la-user-plus"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-30">
                <div class="dashbord-user style-two">
                    <div class="dashboard-content">
                        <div class="title">
                            <span>Total Deposit</span>
                        </div>
                        <div class="user-count">
                            <span>123</span>
                        </div>
                        <div class="view-all-btn">
                            <a href="#0">View All</a>
                        </div>
                    </div>
                    <div class="dashboard-icon-area">
                        <div class="user-last">
                            <p>Last week <span class="r-color">-73</span></p>
                        </div>
                        <div class="dashboard-icon orange-color">
                            <i class="las la-credit-card"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-30">
                <div class="dashbord-user style-two">
                    <div class="dashboard-content">
                        <div class="title">
                            <span>Total Withdraw</span>
                        </div>
                        <div class="user-count">
                            <span>254</span>
                        </div>
                        <div class="view-all-btn">
                            <a href="#0">View All</a>
                        </div>
                    </div>
                    <div class="dashboard-icon-area">
                        <div class="user-last">
                            <p>Last week <span class="r-color">-143</span></p>
                        </div>
                        <div class="dashboard-icon red-color">
                            <i class="las la-city"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-30">
                <div class="dashbord-user style-two">
                    <div class="dashboard-content">
                        <div class="title">
                            <span>Total Chart / History</span>
                        </div>
                        <div class="user-count">
                            <span>855</span>
                        </div>
                        <div class="view-all-btn">
                            <a href="#0">View All</a>
                        </div>
                    </div>
                    <div class="dashboard-icon-area">
                        <div class="user-last">
                            <p>Last week <span class="g-color">+976</span></p>
                        </div>
                        <div class="dashboard-icon blue-color">
                            <i class="las la-history"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="dashboard-item-area mt-20">
        <div class="row justify-content-center mb-30-none">
            <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-30">
                <div class="dashbord-user style-two">
                    <div class="dashboard-content">
                        <div class="title">
                            <span>Total Users</span>
                        </div>
                        <div class="user-count d-flex">
                            <span>155</span>
                        </div>
                        <div class="view-all-btn">
                            <a href="#0">View All</a>
                        </div>
                    </div>
                    <div class="dashboard-icon-area">
                        <div class="user-last">
                            <p>Last week <span class="g-color">+233</span></p>
                        </div>
                        <div class="dashboard-icon base-color">
                            <i class="las la-user-plus"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-30">
                <div class="dashbord-user style-two">
                    <div class="dashboard-content">
                        <div class="title">
                            <span>Total Deposit</span>
                        </div>
                        <div class="user-count">
                            <span>123</span>
                        </div>
                        <div class="view-all-btn">
                            <a href="#0">View All</a>
                        </div>
                    </div>
                    <div class="dashboard-icon-area">
                        <div class="user-last">
                            <p>Last week <span class="r-color">-73</span></p>
                        </div>
                        <div class="dashboard-icon orange-color">
                            <i class="las la-credit-card"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-30">
                <div class="dashbord-user style-two">
                    <div class="dashboard-content">
                        <div class="title">
                            <span>Total Withdraw</span>
                        </div>
                        <div class="user-count">
                            <span>254</span>
                        </div>
                        <div class="view-all-btn">
                            <a href="#0">View All</a>
                        </div>
                    </div>
                    <div class="dashboard-icon-area">
                        <div class="user-last">
                            <p>Last week <span class="r-color">-143</span></p>
                        </div>
                        <div class="dashboard-icon red-color">
                            <i class="las la-city"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-30">
                <div class="dashbord-user style-two">
                    <div class="dashboard-content">
                        <div class="title">
                            <span>Total Chart / History</span>
                        </div>
                        <div class="user-count">
                            <span>855</span>
                        </div>
                        <div class="view-all-btn">
                            <a href="#0">View All</a>
                        </div>
                    </div>
                    <div class="dashboard-icon-area">
                        <div class="user-last">
                            <p>Last week <span class="g-color">+976</span></p>
                        </div>
                        <div class="dashboard-icon blue-color">
                            <i class="las la-history"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="dashboard-item-area two mt-20">
        <div class="row justify-content-center mb-30-none">
            <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-30">
                <div class="dashbord-user style-two style-three">
                    <div class="dashboard-content">
                        <div class="title">
                            <span>Support Ticket</span>
                        </div>
                        <div class="user-count d-flex">
                            <span>10</span>
                        </div>
                        <div class="user-last">
                            <p>Completed <span class="g-color">90%</span></p>
                        </div>
                    </div>
                    <div class="dashboard-icon-area">
                        <div class="dashboard-icon red-color">
                            <i class="las la-ticket-alt"></i>
                        </div>
                        <div class="view-all-btn">
                            <a href="#0">View All</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-30">
                <div class="dashbord-user style-two style-three">
                    <div class="dashboard-content">
                        <div class="title">
                            <span>Active Users</span>
                        </div>
                        <div class="user-count">
                            <span>123</span>
                        </div>
                        <div class="user-last">
                            <p>Active User <span class="r-color">79%</span></p>
                        </div>
                    </div>
                    <div class="dashboard-icon-area">
                        <div class="dashboard-icon base-color">
                            <i class="las la-user-check"></i>
                        </div>
                        <div class="view-all-btn">
                            <a href="#0">View All</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-30">
                <div class="dashbord-user style-two style-three">
                    <div class="dashboard-content">
                        <div class="title">
                            <span>Active Agents</span>
                        </div>
                        <div class="user-count">
                            <span>243</span>
                        </div>
                        <div class="user-last">
                            <p>Completed <span class="g-color">83%</span></p>
                        </div>
                    </div>
                    <div class="dashboard-icon-area">
                        <div class="dashboard-icon blue-color">
                            <i class="las la-users-cog"></i>
                        </div>
                        <div class="view-all-btn">
                            <a href="#0">View All</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-30">
                <div class="dashbord-user style-two style-three">
                    <div class="dashboard-content">
                        <div class="title">
                            <span>Total Receiver</span>
                        </div>
                        <div class="user-count">
                            <span>103</span>
                        </div>
                        <div class="user-last">
                            <p>Completed <span>79%</span></p>
                        </div>
                    </div>
                    <div class="dashboard-icon-area">
                        <div class="dashboard-icon orange-color">
                            <i class="las la-user-edit"></i>
                        </div>
                        <div class="view-all-btn">
                            <a href="#0">View All</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="dashboard-item-area style-two mt-20">
        <div class="row justify-content-center m-0">
            <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-12 p-0">
                <div class="dashbord-user">
                    <div class="flat-card-content">
                        <div class="title">
                            <span>CAMPAIGN</span>
                        </div>
                        <div class="user-count d-flex">
                            <i class="las la-street-view"></i>
                            <h2><span>2,873</span></h2>
                        </div>
                    </div>
                    <div class="dashboard-icon-area">
                        <div class="flat-card g-color">
                            <i class="las la-arrow-circle-up"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-12 p-0">
                <div class="dashbord-user">
                    <div class="flat-card-content">
                        <div class="title">
                            <span>ANNUAL PROFIT</span>
                        </div>
                        <div class="user-count d-flex">
                            <i class="las la-coins"></i>
                            <h2><span>$478.5k</span></h2>
                        </div>
                    </div>
                    <div class="dashboard-icon-area">
                        <div class="flat-card r-color">
                            <i class="las la-arrow-circle-down"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-12 p-0">
                <div class="dashbord-user">
                    <div class="flat-card-content">
                        <div class="title">
                            <span>COVERSATION</span>
                        </div>
                        <div class="user-count d-flex">
                            <i class="las la-wave-square"></i>
                            <h2><span>32.89%</span></h2>
                        </div>
                    </div>
                    <div class="dashboard-icon-area">
                        <div class="flat-card g-color">
                            <i class="las la-arrow-circle-up"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-12 p-0">
                <div class="dashbord-user">
                    <div class="flat-card-content">
                        <div class="title">
                            <span>AVERAGE INCOME</span>
                        </div>
                        <div class="user-count d-flex">
                            <i class="las la-trophy"></i>
                            <h2><span>$1,375.2</span></h2>
                        </div>
                    </div>
                    <div class="dashboard-icon-area">
                        <div class="flat-card r-color">
                            <i class="las la-arrow-circle-down"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
