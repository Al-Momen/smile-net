@extends('admin.layout.master')
@section('title')
    Contact & Social Link
@endsection
@section('page-name')
    Contact & Social Link
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
            <a href="{{ route('admin.price.index') }}">
                <span class="active-path g-color">Social Link</span>
            </a>
            <i class="las la-angle-right"></i>
            <a href="#">
                <span class="active-path g-color">Edit Contact & Social Link</span>
            </a>
        </div>
        <div class="view-prodact">

            </a>
        </div>
    </div>
    <div>
        <div class="shadow-lg p-4 card-1 my-3">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!-- Button trigger modal -->
            <div>
                <form action="{{ route('admin.social.update', $socialLink->id) }}" method="POST">
                    @csrf
                    <div>
                        
                        <div class="user-info-header two mb-4">
                            <h5 class="title text--base">@lang('Edit Contact & Social Link')</h5>
                        </div>
                        <div>
                            <div class="form-group">
                                <label>@lang('Social Email')</label>
                                <input class="form--control" type="text" name="email"
                                    placeholder="@lang('Currency Name')" required value="{{ $socialLink->email }}">
                            </div>
                            <div class="form-group">
                                <label>@lang('Phone')</label>
                                <input class="form--control " type="text" name="phone"
                                    placeholder="@lang('e.g: USD')" required value="{{ $socialLink->phone }}">
                            </div>
                            <div class="form-group">
                                <label>@lang('Address')</label>
                                <input class="form--control " type="text" name="address"
                                    placeholder="@lang('e.g: $')" required value="{{ $socialLink->address }}">
                            </div>
                            <div class="form-group">
                                <label>@lang('Facebook-link')</label>
                                <input class="form--control " type="text" name="fb_link"
                                    placeholder="@lang('e.g: $')" required value="{{ $socialLink->fb_link }}">
                            </div>
                            <div class="form-group">
                                <label>@lang('Address')</label>
                                <input class="form--control " type="text" name="twitter_link"
                                    placeholder="@lang('e.g: $')" required value="{{$socialLink->twitter_link }}">
                            </div>
                            <div class="form-group">
                                <label>@lang('Instragram-link')</label>
                                <input class="form--control " type="text" name="instragram_link"
                                    placeholder="@lang('e.g: $')" required value="{{ $socialLink->instragram_link }}">
                            </div>
                            <div class="form-group">
                                <label>@lang('Linkedin-link')</label>
                                <input class="form--control " type="text" name="linkedin_link"
                                    placeholder="@lang('e.g: $')" required value="{{ $socialLink->linkedin_link }}">
                            </div>
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn--base bg-primary">Update</button>
                        <button type="button" class="btn--base bg-danger" data-bs-dismiss="modal"><a
                                href="{{ route('admin.social.index') }}">Close</a></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
@endsection
