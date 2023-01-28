@extends('admin.layout.master')
@section('Dashboard', 'active')
@section('Dashboard', 'open')
@section('title')
    @lang('Password Change')
@endsection
@section('page-name')
    @lang('Password Change')
@endsection
@section('content')
    <div class="dashboard-title-part">
        <h5 class="title">Dashboard</h5>
        <a href="{{ route('admin.dashboard') }}" class="dashboard-path">
            <span class="main-path">Dashboards</span>
            <i class="las la-angle-right"></i>
            <span class="active-path g-color">Password Change</span>
        </a>
        <div class="view-prodact">

        </div>
    </div>
     <!-- body-wrapper-start -->

        <div class="user-detail-area">
            <div class="row">
                <div class="col-lg-12">
                    <div class="user-info-header two">
                        <h5 class="title">Password Change</h5>
                    </div>
                    <div class="dashboard-form-area two mt-10">
                        <form class="dashboard-form" action="{{route('admin.update.password',$profile->id)}}" method="POST">
                            @csrf
                            <div class="row justify-content-center mb-10-none">
                                <div class="col-lg-12 form-group">
                                    <label>Old Password*</label>
                                    <input type="password" name="old_password" class="form--control"
                                        placeholder="old Password">
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label>New Password*</label>
                                    <input type="password" name="new_password" class="form--control"
                                        placeholder="New Password">
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label>Confirm Password*</label>
                                    <input type="password" name="confirm_password" class="form--control"
                                        placeholder="Confirm Password">
                                </div>
                                <div class="col-lg-12 form-group">
                                    <button type="submit" class="btn btn--base w-100 mt-20">Save & Change</button>
                                </div>
                            </div>
                        </form>
                    </div>
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
