@php
    $prefix = Request::route()->getPrefix();
           $route = Route::current()->getname();
$user = \Illuminate\Support\Facades\Auth::user();
@endphp

<div class="user-sidebar text-center">
    <div class="user-thumb mb-4">
        @if($user->image)
        <img src="{{asset($user->image)}}" alt="user image">
        @else
            <img src="{{asset('assets/assets/image/avatar.jpg')}}" alt="user image">
        @endif
    </div>
    <h5 class="name">{{$user->name}}</h5>
    <p class="fs-14px">{{$user->role == 1 ?'Admin':'User'}} Account</p>
    <hr>
    <ul class="sidebar-menu">
        <li class="{{($route == 'host_meeting')?'active': ''}}"><a href="{{route('host_meeting')}}">Host a Meeting</a></li>
        <li class="{{($route == 'join_meeting')?'active': ''}}"><a href="{{route('join_meeting')}}">Join a Meeting</a></li>
{{--        <li><a href="#0">Schedule a Meeting</a></li>--}}
        <li class="{{($route == 'meeting_history')?'active': ''}}"><a href="{{route('meeting_history')}}">Meeting History</a></li>
    </ul>
    <hr>
    <ul class="sidebar-menu">
        <li><a href="{{route('profile_info')}}">Profile Info</a></li>
{{--        <li><a href="#0">Upgrade Plan</a></li>--}}
{{--        <li><a href="#0">Billing</a></li>--}}
        <li><a href="{{route('change_pass')}}">Change Password</a></li>
    </ul>
</div>
