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
        <h5 class="title">Dashboard</h5>
        <div class="dashboard-path">
            <span class="main-path">Payment Gateway</span>
            <i class="las la-angle-right"></i>
            <span class="active-path g-color">Manual Gateways</span>
        </div>

        <div class="view-prodact">
            <a href="{{ route('admin.gateway.manual.index') }}">
                <i class="las la-arrow-left align-middle me-1"></i>
                <span>Go Back</span>
            </a>
        </div>
    </div>

    <div class="user-detail-area">
        <div class="row mb-30-none">
            <div class="col-lg-12 mb-30">
                <div class="user-info-header two">
                    <h5 class="title">Manual Gateway</h5>
                </div>
                <form action="{{ route('admin.gateway.manual.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="dashboard-form-area two mt-10">
                        <div class="image-upload-wrapper style">
                            <div class="image-upload-area">
                                <div class="image-upload">
                                    <div class="thumb">
                                        <div class="avatar-preview">
                                            <div class="profilePicPreview bg_img"
                                                data-background="{{ getImage(imagePath()['gateway']['path'], imagePath()['gateway']['size']) }}">
                                                <button type="button" class="remove-image"><i
                                                        class="fa fa-times"></i></button>
                                            </div>
                                        </div>
                                        <div class="avatar-edit">
                                            <input type='file' class="profilePicUpload" name="image"
                                                id="profilePicUpload2" accept=".png, .jpg, .jpeg" />
                                            <label for="profilePicUpload2"><i class="las la-pen"></i></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="image-upload-content two">
                                    <div class="image-upload-form-two">
                                        <div class="row">
                                            <div class="col-lg-6 form-group">
                                                <label>Gateway Name *</label>
                                                <input type="text" class="form--control" name="name"
                                                    value="{{ old('name') }}">
                                            </div>
                                            <div class="col-lg-6 form-group">
                                                <label>Currency *</label>
                                                <input type="text" class="form--control" name="currency"
                                                    value="{{ old('currency') }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 form-group">
                                                <label>rate*</label>
                                                <input type="text" class="form--control" name="rate"
                                                    value="{{ old('rate') }}">
                                            </div>
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
                                    <div class="dashboard-form">
                                        <div class="row justify-content-center mb-10-none">
                                            <div class="col-lg-12 form-group">
                                                <label>Minimum Amount</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text copytext curName"></span>
                                                    </div>
                                                    <input type="text" class="form--control" name="min_limit"
                                                        placeholder="0" value="{{ old('min_limit') }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-12 form-group">
                                                <label>Maximum Amount</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text copytext curName"></span>
                                                    </div>
                                                    <input type="text" class="form--control" placeholder="0"
                                                        name="max_limit" value="{{ old('max_limit') }}">
                                                </div>
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
                                    <div class="dashboard-form">
                                        <div class="row justify-content-center mb-10-none">
                                            <div class="col-lg-12 form-group">
                                                <label>Fixed Charge *</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text copytext curName"></span>
                                                    </div>
                                                    <input type="text" class="form--control"placeholder="0"
                                                        name="fixed_charge" value="{{ old('fixed_charge') }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-12 form-group">
                                                <label>Percent Charge *</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text copytext">%</span>
                                                    </div>
                                                    <input type="text" class="form--control" placeholder="0"
                                                        name="percent_charge" value="{{ old('percent_charge') }}">
                                                </div>
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
                                        <div class="col-lg-12 form-group">
                                            {{-- <textarea class="form--control nicEdit" placeholder="Write Text Here" name="instruction">{{ old('instruction') }}</textarea> --}}
                                            <textarea id="editor" name="description" rows="5" class="form-control" value=""></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-30">
                                <div class="gateway-item">
                                    <div class="user-info-header two">
                                        <h5 class="title">User Data</h5>
                                        <button type="button" class="btn--base active addUserData"><i
                                                class="las la-plus"></i> Add</button>
                                    </div>
                                    <div class="dashboard-form">
                                        <div class="row justify-content-center mb-10-none">
                                            <div role="form">
                                                {{-- <div class="form-group">
                                                <div class="input-group row ">
                                                    <div class="col-md-4">
                                                        <input name="field_name[]" class="form-control form--control" type="text" required placeholder="@lang('Field Name')">
                                                    </div>
                                                    <div class="col-md-3 mt-md-0 mt-2">
                                                        <select name="type[]" class="form-control form--control">
                                                            <option value="text" > @lang('Input Text') </option>
                                                            <option value="textarea" > @lang('Textarea') </option>
                                                            <option value="file"> @lang('File') </option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3 mt-md-0 mt-2">
                                                        <select name="validation[]"
                                                                class="form-control form--control">
                                                            <option value="required"> @lang('Required') </option>
                                                            <option value="nullable">  @lang('Optional') </option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2 mt-md-0 mt-2 text-right">

                                                            <button class="btn--base bg--danger removeBtn w-100" type="button">
                                                                <i class="fa fa-times"></i>
                                                            </button>

                                                    </div>
                                                </div>
                                            </div> --}}

                                                <div class="row addedField">
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="gateway-btn mt-20">
                            <button type="submit" class="btn--base w-100 mt-20">Update Settings</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('css')
    <style>
        /* Ck-editor css */
        .ck-blurred {
            height: 400px !important;
        }

        .ck-rounded-corners .ck.ck-editor__main>.ck-editor__editable,
        .ck.ck-editor__main>.ck-editor__editable.ck-rounded-corners {
            height: 400px;
        }
    </style>
@endpush
@section('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
    <script>
        let editor;
        ClassicEditor
            .create(document.querySelector('#editor'))
            .then(newEditor => {
                editor = newEditor;
            })
            .catch(error => {
                console.error(error);
            });
        $('#btn_add').click(function() {
            var descriptionData = editor.getData();
        })
    </script>
    <script>
        (function($) {
            "use strict";
            $('input[name=currency]').on('input', function() {
                $('.curName').text($(this).val());
            });
            $('.addUserData').on('click', function() {
                var html = `
                <div class="col-md-12 user-data">
                    <div class="form-group">
                        <div class="input-group row ">
                            <div class="col-md-4">
                                <input name="field_name[]" class="form-control form--control" type="text" required placeholder="@lang('Field Name')">
                            </div>
                            <div class="col-md-3 mt-md-0 mt-2">
                                <select name="type[]" class="form-control form--control">
                                    <option value="text" > @lang('Input Text') </option>
                                    <option value="textarea" > @lang('Textarea') </option>
                                    <option value="file"> @lang('File') </option>
                                </select>
                            </div>
                            <div class="col-md-3 mt-md-0 mt-2">
                                <select name="validation[]"
                                        class="form-control form--control">
                                    <option value="required"> @lang('Required') </option>
                                    <option value="nullable">  @lang('Optional') </option>
                                </select>
                            </div>
                            <div class="col-md-2 mt-md-0 mt-2 text-right">

                                    <button class="btn--base bg--danger removeBtn w-100" type="button">
                                        <i class="fa fa-times"></i>
                                    </button>

                            </div>
                        </div>
                    </div>
                </div>`;
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
