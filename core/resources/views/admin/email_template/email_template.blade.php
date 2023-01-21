@extends('admin.layout.master')
@section('title')
    Email Template
@endsection
@section('page-name')
Email Template
@endsection

@php
$roles = userRolePermissionArray();
@endphp
@section('content')
    <div class="row">
        <div class="table-area">
            <div class="row">
                <div class="col-lg-12">
                    <div class="user-info-header two">
                        <h5 class="title">Global Email Template</h5>
                    </div>
                    <div class="table-wrapper table-responsive">
                        <table class="custom-table">
                            <thead>
                                <tr>
                                    <th>Short Code</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>@{{ full name }}</td>
                                    <td>User Full Name</td>
                                </tr>
                                <tr>
                                    <td>@{{ username }}</td>
                                    <td>Username</td>
                                </tr>
                                <tr>
                                    <td>@{{ message }}</td>
                                    <td>Message</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">

            <div class="user-detail-area mt-30">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="user-info-header two">
                            <h5 class="title">Email Sent From</h5>
                        </div>
                        <div class="dashboard-form-area two mt-10">
                            <form class="dashboard-form" action="{{ route('admin.email.template.global.update') }}"
                                method="POST">
                                @csrf
                                <div class="row justify-content-center mb-10-none">
                                    <div class="col-lg-12 form-group">
                                        <input type="text" class="form--control" placeholder="@lang('Email address')"
                                            name="email_from" value="{{ $general->email_from }}" required>
                                    </div>
                                    {{-- <div class="col-lg-12 form-group">
                                        <textarea id="editor" class="form--control" name="email_template" placeholder="@lang('Your email template')">{{ $general->email_template }}</textarea>
                                    </div> --}}
                                    <div class="form-group col-md-12 col-sm-6">
                                        <label class="font-weight-bold">@lang('Email Body') <span
                                                class="text-danger">*</span></label>
                                        <textarea name="email_template" rows="10" class="form--control nicEdit"
                                            placeholder="@lang('Your email template')">{{ $general->email_template }}</textarea>
                                    </div>
                                    <div class="col-lg-12 form-group">
                                        <button type="submit" class="btn btn--base w-100">Submit</button>
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

@push('css')
    <style>
        /* Ck-editor css */
        .ck-blurred {
            height: 300px !important;
        }

        .ck-rounded-corners .ck.ck-editor__main>.ck-editor__editable,
        .ck.ck-editor__main>.ck-editor__editable.ck-rounded-corners {
            height: 300px;
        }
    </style>
@endpush

@push('js')
<script>
    $('.switch').click(function() {
        $(this).parents('form').submit();
    })
    $('#doller-input')
</script>
    {{-- <script>
        (function($, document) {
            "use strict";
            bkLib.onDomLoaded(function() {
                $(".nicEdit").each(function(index) {
                    $(this).attr("id", "nicEditor" + index);
                    new nicEditor({
                        fullPanel: true
                    }).panelInstance('nicEditor' + index, {
                        hasPanel: true
                    });
                });
            });
            $(document).on('mouseover ', '.nicEdit-main,.nicEdit-panelContain', function() {
                $('.nicEdit-main').focus();
            });
        })(jQuery, document);
    </script> --}}
    {{-- <script src="{{ asset('assets/admin/js/nicEdit.js') }}"></script> --}}



    
    
    {{-- Ck-editor js --}}
    {{-- <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
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
    </script> --}}
@endpush
