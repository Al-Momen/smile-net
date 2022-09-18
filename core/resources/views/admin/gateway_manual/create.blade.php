@extends('admin.layout.master')
@section('title')
    Manual Gateways
@endsection
@section('page-name')
    Manual Gateways
@endsection
@php
$roles = userRolePermissionArray();
@endphp
@section('content')
    <div class="dashboard-title-part">
        <div class="view-prodact">
            <a href="#">
                <i class="las la-arrow-left align-middle me-1"></i>
                <span>Go Back</span>
            </a>
        </div>
        <div class="dashboard-path">
            <span class="main-path">Payment Gateway</span>
            <i class="las la-angle-right"></i>
            <span class="active-path g-color">Manual Gateways</span>
        </div>
        <h5 class="title">Dashboard</h5>
    </div>

    <div class="user-detail-area">
        <div class="row mb-30-none">
            <div class="col-lg-12 mb-30">
                <div class="user-info-header two">
                    <h5 class="title">Manual Gateway</h5>
                </div>
                <form class="dashboard-form" action="{{ route('admin.gateway.manual.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="dashboard-form-area two mt-10">
                        <div class="image-upload-wrapper style">
                            <div class="image-upload-area">
                                <div class="image-upload">
                                    <div class="thumb">
                                        <div class="avatar-preview">
                                            <div class="profilePicPreview bg_img"
                                                data-background="assets/images/paypal-m.png"
                                                style="background-image: url(&quot;assets/images/paypal-m.png&quot;);">
                                                <button type="button" class="remove-image"><i
                                                        class="fa fa-times"></i></button>
                                            </div>
                                        </div>
                                        <div class="avatar-edit">
                                            <input type="file" class="profilePicUpload" name="image"
                                                id="profilePicUpload2" accept=".png, .jpg, .jpeg">
                                            <label for="profilePicUpload2"><i class="las la-pen"></i></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="image-upload-content two">

                                    <div class="row">
                                        <div class="col-lg-6 form-group">
                                            <label>Gateway Name *</label>
                                            <input type="text" class="form--control" value="{{ old('name') }}"
                                                name="name" placeholder="Stripe">
                                        </div>
                                        <div class="col-lg-6 form-group">
                                            <label>Currency *</label>
                                            <input type="text" class="form--control" value="USD" name="currency"
                                                {{ old('currency') }}>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-30-none">
                            <div class="col-lg-6 col-md-6 mb-30">
                                <div class="gateway-item">
                                    <div class="user-info-header two">
                                        <h5 class="title">Range</h5>
                                    </div>

                                    <div class="row justify-content-center mb-10-none">
                                        <div class="col-lg-12 form-group">
                                            <label>Minimum Amount</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text copytext curName">USD</span>
                                                </div>
                                                <input type="number" name="min_limit" class="form--control" placeholder="0"
                                                    value="{{ old('min_limit') }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 form-group">
                                            <label>Maximum Amount</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text copytext curName">USD</span>
                                                </div>
                                                <input type="number" class="form--control" placeholder="0"
                                                    value="{{ old('max_limit') }}" name="max_limit">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="gateway-item">
                                    <div class="user-info-header two">
                                        <h5 class="title">Charge</h5>
                                    </div>

                                    <div class="row justify-content-center mb-10-none">
                                        <div class="col-lg-12 form-group">
                                            <label>Fixed Charge *</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text copytext curName">USD</span>
                                                </div>
                                                <input type="number" name="fixed_charge" class="form--control"
                                                    placeholder="0" value="{{ old('fixed_charge') }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 form-group">
                                            <label>Percent Charge *</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text copytext curName">%</span>
                                                </div>
                                                <input type="number" name="percent_charge" class="form--control"
                                                    placeholder="0" value="{{ old('percent_charge') }}">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-12 mt-30">
                                <div class="gateway-item">
                                    <div class="user-info-header two">
                                        <h5 class="title">Deposit Instruction</h5>
                                    </div>
                                    <div class="row justify-content-center mb-10-none">

                                        <textarea class="form--control" name="instruction" id="" cols="30" rows="10"
                                            placeholder="Write Text Here"></textarea>

                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-12 mt-30">
                                <div class="gateway-item">
                                    <div class="user-info-header two">
                                        <h5 class="title">User Data</h5>
                                        <button type="button" class="btn--base active addUserData"><i
                                                class="la la-fw la-plus"></i>@lang('Add New')
                                        </button>
                                    </div>
                                    <div class="row justify-content-center mb-10-none addedField">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="gateway-btn mt-20">
                            <button type="submit" class="btn--base w-100 mt-20">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        (function($) {
            "use strict";
            $('input[name=currency]').on('input', function() {
                $('.curName').text($(this).val());
            });
            $('.addUserData').on('click', function() {
                var html = `
                        <div class="row ptb-30 justify-content-center mb-10-none">
                            <div class="col-lg-4 col-md-4  form-group">
                                <input name="field_name[]" class="form-control form--control" type="text" required placeholder="@lang('Field Name')">
                            </div>
                            <div class="col-lg-3 col-md-3 form-group">
                                <select name="type[]" class="form-control form--control">
                                    <option value="text" > @lang('Input Text') </option>
                                    <option value="textarea" > @lang('Textarea') </option>
                                    <option value="file"> @lang('File') </option>
                                </select>
                            </div>
                            <div class="col-lg-3 col-md-3 form-group">
                                <select name="validation[]"
                                        class="form-control form--control">
                                    <option value="required"> @lang('Required') </option>
                                    <option value="nullable">  @lang('Optional') </option>
                                </select>
                            </div>
                            <div class="col-lg-2 col-md-2 form-group">
                                    <a class="btn--base bg--danger w-100 removeBtn w-100" type="button">
                                        <i class="fa fa-times"></i>
                                    </a>
                            </div>
                        </div>
                `;
                $('.addedField').append(html)
            });

            $(document).on('click', '.removeBtn', function() {
                $(this).closest('.user-data').remove();
            });

            @if (old('currency'))
                $('input[name=currency]').trigger('input');
            @endif

        })(jQuery);
    </script>
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
@endsection
