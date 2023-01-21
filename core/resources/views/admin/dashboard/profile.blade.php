@extends('admin.layout.master')
@section('Dashboard', 'active')
@section('Dashboard', 'open')
@section('title')
    @lang(' Admin profile')
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
            <span class="active-path g-color">Profile</span>
        </a>
        <div class="view-prodact">

        </div>
    </div>
        <div class="user-detail-area">
            <div class="user-info-header two">
                <h5 class="title">Profile Settings</h5>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="dashboard-form-area two mt-10">
                        <form class="dashboard-form" action="{{ route('admin.profile.update') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-30-none">
                                <div class="col-lg-4 mb-30">
                                    <div class="overview-wrapper">
                                        <div class="user-detail-thumb two">
                                            <span class="title">Profile Image: (350x300px)</span>
                                            <div class="image-upload">
                                                <div class="thumb">
                                                    {{-- <div class="avatar-preview">
                                                        <div class="profilePicPreview bg_img"
                                                            data-background="D:/laragon/www/smile-net/core/storage/app/public/monkey-g2f439ccf9_640.jpg">
                                                            <button type="button" class="remove-image"><i
                                                                    class="fa fa-times"></i></button>
                                                        </div>
                                                    </div>
                                                    <div class="avatar-edit">
                                                        <input type='file' class="profilePicUpload" name="image"
                                                            id="profilePicUpload2" accept="image/*" />
                                                        <label for="profilePicUpload2"><i class="las la-pen"></i></label>
                                                    </div> --}}
                                                    <img class="img-fluid rounded d-block mx-auto" 
                                                        src="{{ asset('core\storage\app\public\admin-profile\\' . $profile->adminUser->profile_pic) }}"
                                                        alt="Image" height="350" width="300">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8 mb-30">
                                    <div class="row justify-content-center mb-10-none">
                                        <div class="col-lg-12 form-group">
                                            <label>First Name*</label>
                                            <input type="text" name="first_name" class="form--control"
                                                placeholder="first name"
                                                value="{{ $profile->adminUser->first_name ?? null }}">
                                        </div>
                                        <div class="col-lg-12 form-group">
                                            <label>Last Name*</label>
                                            <input type="text" name="last_name" class="form--control"
                                                placeholder="first name"
                                                value="{{ $profile->adminUser->last_name ?? null }}">
                                        </div>
                                        <div class="col-lg-12 form-group">
                                            <label>User Name*</label>
                                            <input type="text" name="user_name" class="form--control"
                                                placeholder="user name" value="{{ $profile->username ?? null }}">
                                        </div>
                                        <div class="col-lg-12 form-group">
                                            <label>Designation*</label>
                                            <input type="text" name="designation" class="form--control"
                                                placeholder="designation"
                                                value="{{ $profile->adminUser->designation ?? null }}">
                                        </div>
                                        <div class="col-lg-12 col-md-6 form-group">
                                            <label>Phone Number*</label>
                                            <input type="number" name="phone_number" class="form--control"
                                                placeholder="+880348753049" value="{{ $profile->mobile_no ?? null }}">
                                        </div>

                                        <div class="col-lg-6 col-md-6 form-group">
                                            <label>Address*</label>
                                            <input type="text" name="address" class="form--control"
                                                placeholder="Unaited State"
                                                value="{{ $profile->adminUser->address ?? null }}">
                                        </div>

                                        <div class="col-lg-6 col-md-6 form-group">
                                            <label>Country*</label>
                                            <select
                                                class="form--control selectpicker countrypicker form-select form-select-md mb-3"
                                                style="padding: 12px 10px;" aria-label=".form-select-lg example"
                                                name="country" data-live-search="true" data-default="{{ $profile->adminUser->country ?? null }}"
                                                data-flag="true">
                                            </select>
                                        </div>
                                        <div class="col-lg-12 col-md-6 form-group">
                                            <label>Image</label>
                                            <input type="file" name="image" class="form--control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pro-btn-area mt-30">
                                <button type="submit" class="btn btn--base w-100">Save & Change</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- body-wrapper-start -->

@endsection
@push('js')
    <!-- country js -->
    <script src="{{ URL::asset('assets/frontend/js/countrypicker.min.js') }}"></script>
    <script>
        function proPicURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var preview = $(input).parents('.thumb').find('.profilePicPreview');
                    $(preview).css('background-image', 'url(' + e.target.result + ')');
                    $(preview).addClass('has-image');
                    $(preview).hide();
                    $(preview).fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $(".profilePicUpload").on('change', function() {
            proPicURL(this);
        });

        $(".remove-image").on('click', function() {
            $(this).parents(".profilePicPreview").css('background-image', 'none');
            $(this).parents(".profilePicPreview").removeClass('has-image');
            $(this).parents(".thumb").find('input[type=file]').val('');
        });
    </script>
@endpush
