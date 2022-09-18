@extends('admin.layout.master')
@section('content')
<div class="dashboard-title-part">
    <h5 class="title">Dashboard</h5>
    <div href="" class="dashboard-path">
        <a href={{ route('admin.dashboard') }}>
            <span class="main-path">Dashboard</span>
        </a>
        <i class="las la-angle-right"></i>
        <a href="#">
            <span class="active-path g-color">KYC</span>
        </a>
    </div>
    <div class="view-prodact">
        <a data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="las la-edit"></i>
            <span>Edit KYC</span>
        </a>
    </div>
</div>

<div class="dashboard-form-area">
    <form class="dashboard-form"  action="{{ route('admin.kyc.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-xxl-10 col-xl-9 col-lg-9 col-md-9 col-sm-8 form-group">
                <label class="w-100">@lang('User Type') <span class="text-danger"></span></label>
                <input type="text" class="form-control form--control" disabled value="{{$kyc->user_type}}"/>
                <input type="hidden" name="id" class="form-control"  value="{{$kyc->id}}"/>
            </div>
            <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-4 col-sm-6 form-group">
                <label>Status</label>
                <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="@lang('Active')" data-off="@lang("Iactive")" name="status"  @if($kyc->status) checked @endif>
            </div>
        </div>
        <div class="user-info-header two mb-20">
            <h5 class="title">User data form</h5>
            <button type="button" class="btn--base active addUserData"><i class="las la-plus"></i> Add</button>
        </div>
            <div class=" justify-content-center mb-10-none addedField">
                @if($kyc->form_data != null)
                @foreach($kyc->form_data as $k => $v)

                        <div class="form-group ">
                            <div class="input-group row user-data">

                                <div class="col-lg-4 col-md-4 form-group">
                                    <input type="text" name="field_name[]" class="form-control form--control" value="{{$v->field_level}}" required placeholder="@lang('Field Name')">
                                </div>
                                <div class="col-lg-3 col-md-3 form-group">
                                    <select name="type[]" class="form-control form--control">
                                        <option value="text" @if($v->type == 'text') selected @endif>
                                            @lang('Input Text')
                                        </option>
                                        <option value="textarea" @if($v->type == 'textarea') selected @endif>
                                            @lang('Textarea')
                                        </option>
                                        <option value="file" @if($v->type == 'file') selected @endif>
                                            @lang('File')
                                        </option>
                                    </select>
                                </div>
                                <div class="col-lg-3 col-md-3 form-group">
                                    <select name="validation[]" class="form-control form--control">
                                        <option value="required" @if($v->validation == 'required') selected @endif> @lang('Required') </option>
                                        <option value="nullable" @if($v->validation == 'nullable') selected @endif>  @lang('Optional') </option>
                                    </select>
                                </div>
                                <div class="col-lg-2 col-md-2 form-group">

                                        <button class="btn--base bg--danger removeBtn w-100" type="button">
                                            <i class="fa fa-times"></i>
                                        </button>

                                </div>

                            </div>
                        </div>

                @endforeach
            @endif
            </div>
            <div class="col-xl-12">
                <button type="submit" class="btn--base w-100 mt-20">Save & Change</button>
            </div>

    </form>
</div>
@endsection
@push('script')
    <script>
        (function ($) {
            "use strict";
            $('.addUserData').on('click', function () {
                var html = `
                    <div class="">
                        <div class="form-group">
                            <div class="input-group row user-data">
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

                $('.addedField').append(html);
            });
            $(document).on('click', '.removeBtn', function () {
                $(this).closest('.user-data').remove();
            });
        })(jQuery);
    </script>
@endpush
