@extends('admin.layout.master')
@section('title')
    System Information
@endsection
@section('page-name')
    System Information Page
@endsection
@php
$roles = userRolePermissionArray();
@endphp
@section('content')
    <div class="user-detail-area">
        <div class="user-info-header two">
            <h5 class="title">Search Engine Optimization (SEO) -- Ongoing</h5>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="dashboard-form-area two mt-10">
                    <form class="dashboard-form" action="{{ route('admin.setting.seo.update','seo')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="type" value="data">
                        <input type="hidden" name="seo_image" value="1">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="overview-wrapper">
                                    <div class="user-detail-thumb two">
                                        <span class="title">Thumbnail Image: (16:9)</span>
                                        <div class="image-upload">
                                            <div class="thumb">
                                                <div class="avatar-preview">
                                                    <div class="profilePicPreview bg_img"
                                                        data-background="assets/images/eco.png">
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
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="row justify-content-center mb-10-none">
                                    <div class="col-lg-12 form-group">
                                        <label>@lang('Social Title')*</label>

                                        <input type="text" class="form--control" placeholder="@lang('Social Share Title')" name="social_title" value="{{ @$seo->data_values->social_title }}" required/>
                                    </div>
                                    <div class="col-lg-12 form-group">
                                        <label>@lang('Social Description')*</label>
                                        <textarea name="social_description" rows="3" class="form--control" placeholder="@lang('Social Share  meta description')" required>{{ @$seo->data_values->social_description }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-20 form-group">
                                <label>Meta Keywords*</label>
                                <div class="keywords-area" name="keywords[]">
                                    <span class="keyword-tag"><i class="las la-times"></i> digitalwallet</span>
                                    <span class="keyword-tag"><i class="las la-times"></i> digitalwallet</span>
                                    <span class="keyword-tag"><i class="las la-times"></i> digitalwallet</span>
                                    <span class="keyword-tag"><i class="las la-times"></i> digitalwallet</span>
                                    <span class="keyword-tag"><i class="las la-times"></i> digitalwallet</span>
                                </div>
                            </div>

                            <div class="col-lg-12 form-group">
                                <label>@lang('Meta Description')*</label>
                                <textarea name="description" rows="3" class="form--control" placeholder="@lang('SEO meta description')" required>{{ @$seo->data_values->description }}</textarea>
                            </div>
                        </div>
                        <div class="info-two-btn">
                            <button type="submit" class="btn btn--base w-100 mt-20"><i class="las la-cloud-upload-alt"></i>@lang('Update')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
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
