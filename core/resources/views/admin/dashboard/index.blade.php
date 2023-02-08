@extends('admin.layout.master')
@section('Dashboard', 'active')
@section('Dashboard', 'open')
@section('title')
    @lang('Deshboard')
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
        {{-- <a href="">
            <i class="las la-eye align-middle me-1"></i>
            <span></span>
        </a> --}}
    </div>
</div>

@php
    $total_user = \App\Models\GeneralUser::get();
    $active_user = \App\Models\GeneralUser::where('access',0)->get();
    $banned_user = \App\Models\GeneralUser::where('access',1)->get();
    $plan_user = \App\Models\TicketTypeDetails::where('status',1)->where('ticket_status',1)->get();
    $all_books = \App\Models\Book::get();
    $active_books = \App\Models\Book::where('status',1)->get();
    $pending_books = \App\Models\Book::where('status',0)->get();
    $admin_books = \App\Models\Book::where('author_book_id', auth()->id())->get();
    $total_Events = \App\Models\Event::get();
    $active_Events = \App\Models\Event::where('status',1)->get();
    $pending_Events = \App\Models\Event::where('status',0)->get();
    $all_logs = \App\Models\EventPlanTransaction::with('user','eventPlans')->where('status','!=', 0)->get();
    $total_walls = \App\Models\AdminNews::where('status',1)->get();
    $my_wall = \App\Models\AdminNews::where('news_type','App\Models\User')->get();
@endphp
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
                            <span>{{$total_user->count()}}</span>
                        </div>
                        <div class="view-all-btn">
                            <a href="{{route('admin.all.users')}}">View All</a>
                        </div>
                    </div>
                    <div class="dashboard-icon-area">
                        <div class="user-last">
                            
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
                            <span>Active User</span>
                        </div>
                        <div class="user-count">
                            <span>{{$active_user->count()}}</span>
                        </div>
                        <div class="view-all-btn">
                            <a href="{{route('admin.active.users')}}">View All</a>
                        </div>
                    </div>
                    <div class="dashboard-icon-area">
                        <div class="user-last">
                            
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
                            <span>Banned User</span>
                        </div>
                        <div class="user-count">
                            <span>{{$banned_user->count()}}</span>
                        </div>
                        <div class="view-all-btn">
                            <a href="{{route('admin.banned.users')}}">View All</a>
                        </div>
                    </div>
                    <div class="dashboard-icon-area">
                        <div class="user-last">
                            
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
                            <span>Subscription Plan</span>
                        </div>
                        <div class="user-count">
                            <span>{{$plan_user->count()}}</span>
                        </div>
                        <div class="view-all-btn">
                            <a href="{{route('admin.plan.users')}}">View All</a>
                        </div>
                    </div>
                    <div class="dashboard-icon-area">
                        <div class="user-last">
                            
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
                            <span>Total Books</span>
                        </div>
                        <div class="user-count d-flex">
                            <span>{{$all_books->count()}}</span>
                        </div>
                        <div class="user-last">
                            
                        </div>
                    </div>
                    <div class="dashboard-icon-area">
                        <div class="dashboard-icon red-color">
                            <i class="las la-book-open"></i>
                        </div>
                        <div class="view-all-btn">
                            <a href="{{route('admin.book.all.books')}}">View All</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-30">
                <div class="dashbord-user style-two style-three">
                    <div class="dashboard-content">
                        <div class="title">
                            <span>Active Books</span>
                        </div>
                        <div class="user-count d-flex">
                            <span>{{$active_books->count()}}</span>
                        </div>
                        <div class="user-last">
                            
                        </div>
                    </div>
                    <div class="dashboard-icon-area">
                        <div class="dashboard-icon red-color">
                            <i class="las la-book-open"></i>
                        </div>
                        <div class="view-all-btn">
                            <a href="{{route('admin.book.all.books')}}">View All</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-30">
                <div class="dashbord-user style-two style-three">
                    <div class="dashboard-content">
                        <div class="title">
                            <span>Pending Books</span>
                        </div>
                        <div class="user-count d-flex">
                            <span>{{$pending_books->count()}}</span>
                        </div>
                        <div class="user-last">
                            
                        </div>
                    </div>
                    <div class="dashboard-icon-area">
                        <div class="dashboard-icon red-color">
                            <i class="las la-book-open"></i>
                        </div>
                        <div class="view-all-btn">
                            <a href="{{route('admin.book.all.books')}}">View All</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-30">
                <div class="dashbord-user style-two style-three">
                    <div class="dashboard-content">
                        <div class="title">
                            <span>My Books</span>
                        </div>
                        <div class="user-count d-flex">
                            <span>{{$admin_books->count()}}</span>
                        </div>
                        <div class="user-last">
                            
                        </div>
                    </div>
                    <div class="dashboard-icon-area">
                        <div class="dashboard-icon red-color">
                            <i class="las la-book-open"></i>
                        </div>
                        <div class="view-all-btn">
                            <a href="{{route('admin.book.all.books')}}">View All</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-30">
                <div class="dashbord-user style-two style-three">
                    <div class="dashboard-content">
                        <div class="title">
                            <span>Total Events</span>
                        </div>
                        <div class="user-count">
                            <span>{{$total_Events->count()}}</span>
                        </div>
                        <div class="user-last">
                            
                        </div>
                    </div>
                    <div class="dashboard-icon-area">
                        <div class="dashboard-icon orange-color">
                            <i class="las las la-bullhorn"></i>
                        </div>
                        <div class="view-all-btn">
                            <a href="{{route('admin.index.events')}}">View All</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-30">
                <div class="dashbord-user style-two style-three">
                    <div class="dashboard-content">
                        <div class="title">
                            <span>Active Events</span>
                        </div>
                        <div class="user-count">
                            <span>{{$active_Events->count()}}</span>
                        </div>
                        <div class="user-last">
                            
                        </div>
                    </div>
                    <div class="dashboard-icon-area">
                        <div class="dashboard-icon orange-color">
                            <i class="las las la-bullhorn"></i>
                        </div>
                        <div class="view-all-btn">
                            <a href="{{route('admin.index.events')}}">View All</a>
                        </div>
                    </div>
                </div>
            </div>          
            <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-30">
                <div class="dashbord-user style-two style-three">
                    <div class="dashboard-content">
                        <div class="title">
                            <span>Pending Events</span>
                        </div>
                        <div class="user-count">
                            <span>{{$pending_Events->count()}}</span>
                        </div>
                        <div class="user-last">
                            
                        </div>
                    </div>
                    <div class="dashboard-icon-area">
                        <div class="dashboard-icon orange-color">
                            <i class="las las la-bullhorn"></i>
                        </div>
                        <div class="view-all-btn">
                            <a href="{{route('admin.index.events')}}">View All</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-30">
                <div class="dashbord-user style-two style-three">
                    <div class="dashboard-content">
                        <div class="title">
                            <span>All Logs</span>
                        </div>
                        <div class="user-count">
                            <span>{{$all_logs->count()}}</span>
                        </div>
                        <div class="user-last">
                            
                        </div>
                    </div>
                    <div class="dashboard-icon-area">
                        <div class="dashboard-icon orange-color">
                            <i class="las las la-bullhorn"></i>
                        </div>
                        <div class="view-all-btn">
                            <a href="{{route('admin.event.manual.index')}}">View All</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-30">
                <div class="dashbord-user style-two style-three">
                    <div class="dashboard-content">
                        <div class="title">
                            <span>Total Wall</span>
                        </div>
                        <div class="user-count">
                            <span>{{$total_walls->count()}}</span>
                        </div>
                        <div class="user-last">
                            
                        </div>
                    </div>
                    <div class="dashboard-icon-area">
                        <div class="dashboard-icon blue-color">
                            <i class="las la-newspaper"></i>
                        </div>
                        <div class="view-all-btn">
                            <a href="{{route('admin.news.index')}}">View All</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-30">
                <div class="dashbord-user style-two style-three">
                    <div class="dashboard-content">
                        <div class="title">
                            <span>My Walls</span>
                        </div>
                        <div class="user-count">
                            <span>{{$my_wall->count()}}</span>
                        </div>
                        <div class="user-last">
                            
                        </div>
                    </div>
                    <div class="dashboard-icon-area">
                        <div class="dashboard-icon base-color">
                            <i class="las la-newspaper"></i>
                        </div>
                        <div class="view-all-btn">
                            <a href="{{route('admin.all.news')}}">View All</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
