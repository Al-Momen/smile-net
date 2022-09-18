@extends('admin.layout.master')

@section('content')
<div class="user-detail-area">
    <div class="row">
        <div class="col-lg-4 col-md-4">
            <div class="overview-wrapper">
                <div class="user-detail-badge mb-20">
                    <span class="badge text-start"><i class="las la-dot-circle"></i>
                        Overview</span>
                </div>
                <div class="user-detail-thumb">
                    <div class="thumb">
                        <img src=" {{ getImage(imagePath()['profile']['user']['path'].'/'.$user->image,imagePath()['profile']['user']['size'])}} " alt="user">
                    </div>
                </div>
                <div class="user-info-header two mt-30 mb-10">
                    <h5 class="title">User Information</h5>
                </div>
                <div class="user-detail-info">
                    <ul class="user-info-list">
                        <li>Full Name: <span>{{$user->fullname}}</span></li>
                        <li>Username: <span>{{$user->username}}</span></li>
                        <li>Status:
                            @if($user->status)
                            <span class="g-color">Enabled</span>
                            @else
                            <span class="text-danger">Disabled</span>
                            @endif
                        </li>
                        <li>Last Login: <span>2:33 PM, 13 May 2022</span></li>
                        <li>Joined At: <span> {{ showDateTime($user->created_at) }} </span></li>
                    </ul>
                </div>
                <div class="user-info-header two mt-40 mb-10">
                    <h5 class="title">User Action</h5>
                </div>
                <div class="user-detail-action">
                    <ul class="user-action-list">
                        <li>
                            <a href="#0" class="btn--base one w-100">Login Logs</a>
                        </li>
                        <li>
                            <a href="#0" class="btn--base two w-100">Send Email</a>
                        </li>
                        <li>
                            <a href="#0" class="btn--base three w-100">Login as User</a>
                        </li>
                        <li>
                            <a href="#0" class="btn--base four w-100">Email Logs</a>
                        </li>
                        <li>
                            <a href="#0" class="btn--base three w-100">Add / Subtract Money</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-8">
            <div class="user-detail-badge text-start mb-20">
                <span class="badge text-start"><i class="las la-dot-circle"></i> Transaction</span>
            </div>
            <div class="Transactions-wrapper">
                <div class="row mb-30-none">
                    <div class="col-xxl-4 col-xl-6 col-lg-6 col-md-6 col-sm-6 mb-30">
                        <div class="dashbord-user style-two">
                            <div class="dashboard-content">
                                <div class="title">
                                    <span>Total Deposit</span>
                                </div>
                                <div class="user-count d-flex">
                                    <span>$ 0.00</span>
                                </div>
                                <div class="view-all-btn">
                                    <a href="#0">View All</a>
                                </div>
                            </div>
                            <div class="dashboard-icon-area">
                                <div class="dashboard-icon orange-color">
                                    <i class="las la-credit-card"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-4 col-xl-6 col-lg-6 col-md-6 col-sm-6 mb-30">
                        <div class="dashbord-user style-two">
                            <div class="dashboard-content">
                                <div class="title">
                                    <span>Total Withdraw</span>
                                </div>
                                <div class="user-count d-flex">
                                    <span>$ 0.00</span>
                                </div>
                                <div class="view-all-btn">
                                    <a href="#0">View All</a>
                                </div>
                            </div>
                            <div class="dashboard-icon-area">
                                <div class="dashboard-icon red-color">
                                    <i class="las la-city"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-4 col-xl-12 mb-30">
                        <div class="dashbord-user style-two">
                            <div class="dashboard-content">
                                <div class="title">
                                    <span>Total Transaction</span>
                                </div>
                                <div class="user-count d-flex">
                                    <span>0</span>
                                </div>
                                <div class="view-all-btn">
                                    <a href="#0">View All</a>
                                </div>
                            </div>
                            <div class="dashboard-icon-area">
                                <div class="dashboard-icon blue-color">
                                    <i class="las la-exchange-alt"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="user-info-header two mt-30">
                <h5 class="title">Information of {{ ucfirst($user->fullname) }}</h5>
            </div>
            <div class="dashboard-form-area two mt-10">
                <form class="dashboard-form" method="POST" action="{{ route('admin.users.update',$user->id) }}">
                    @csrf
                    <div class="row justify-content-center mb-10-none">
                        <div class="col-lg-6 form-group">
                            <label>First Name</label>
                            <input type="text" name="firstname" class="form--control" value="{{ $user->firstname }}">
                        </div>
                        <div class="col-lg-6 form-group">
                            <label>Last Name</label>
                            <input type="text" name="lastname" class="form--control" value="{{ $user->lastname }}">
                        </div>
                        <div class="col-lg-6 form-group">
                            <label>Email <span class="text--danger">(unchangable)</span></label>
                            <input type="email" name="email" class="form--control" value="{{ $user->email }}" disabled>
                        </div>
                        <div class="col-lg-6 form-group">
                            <label>Phone Number</label>
                            <input type="number" name="mobile" class="form--control" value="{{ $user->mobile }}">
                        </div>
                        <div class="col-lg-12 form-group">
                            <label>Address</label>
                            <input type="text" name="address" class="form--control"
                                placeholder="enter address"  value="{{ $user->address->address??'' }}">
                        </div>
                        <div class="col-lg-6 form-group">
                            <label>City</label>
                            <input type="text" name="city" class="form--control"
                                placeholder="enter city" value="{{ $user->address->city??'' }}">
                        </div>
                        <div class="col-lg-6 form-group">
                            <label>State</label>
                            <input type="text" name="state" class="form--control"
                                placeholder="enter state" value="{{ $user->address->state??'' }}">
                        </div>
                        <div class="col-lg-6 form-group">
                            <label>Zip/Postal</label>
                            <input type="text" name="zip" class="form--control"
                                placeholder="enter zip" value="{{ $user->address->zip??'' }}">
                        </div>
                        <div class="col-lg-6 form-group">
                            <label>Country</label>
                          @isset($user->address->address)
                          <select class="form-control form--control" name="country">
                            @foreach($countries as $key => $country)
                                    <option value="{{ $key }}" @if($country->country == $user->address->country??'' ) selected @endif>{{ __($country->country) }}</option>
                                    @endforeach
                        </select>
                        @else
                        <select class="form-control form--control" name="country">
                            @foreach($countries as $key => $country)
                                    <option value="{{ $key }}">{{ __($country->country) }}</option>
                                    @endforeach
                        </select>

                          @endisset
                        </div>
                    </div>

                <div class="switch-area mt-20">
                    <div class="row justify-content-center">
                        <div class="col-xxl-4 col-lg-6 col-lg-4 col-md-6 col-sm-6 text-center mb-30">
                            <label>Status</label>
                            <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="Active" data-off="Deactive" name="status"
                            @if($user->status) checked @endif >
                        </div>
                        <div class="col-lg-4 col-lg-6 col-xxl-4 col-md-6 col-sm-6 text-center mb-30">
                            <label>Email Verification</label>
                            <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="Verified" data-off="Unverified" name="ev"
                            @if($user->ev) checked @endif >
                        </div>
                        <div class="col-lg-4 col-lg-6 col-xxl-4 col-md-6 col-sm-6 text-center mb-30">
                            <label>SMS Verification</label>
                            <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="Verified" data-off="Unverified" name="sv"
                            @if($user->sv) checked @endif >
                        </div>
                        <div class="col-lg-4 col-lg-6 col-xxl-4 col-md-6 col-sm-6 text-center mb-30">
                            <label>2FA Status</label>
                            <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="Active" data-off="Deactive"  name="ts"
                            @if($user->ts) checked @endif >
                        </div>
                        <div class="col-lg-4 col-lg-6 col-xxl-4 col-md-6 col-sm-6 text-center mb-30">
                            <label>2FA Verification</label>
                            <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="Verified" data-off="Unverified"  name="tv"
                            @if($user->tv) checked @endif >
                        </div>
                        <div class="col-lg-4 col-lg-6 col-xxl-4 col-md-6 col-sm-6 text-center mb-30">
                            <label>KYC Verification</label>
                            <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="Verified" data-off="Unverified" name="kyc_status"    @if($user->kyc_status) checked @endif >
                        </div>
                        <div class="col-lg-12">
                            <div class="user-detail-btn-area mt-20">
                                <button type="submit" class="btn btn--base w-100"><i class="las la-arrow-alt-circle-up"></i> Update</button>
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
