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
                <div class="col-lg-10">
                </div>
                <div class="col-lg-2">
                    <div class=" table-responsive">
                        <a class='btn btn--base'href="{{route('admin.email.template.mail.noticication')}}">Send mail <i class="las la-paper-plane"></i></a>
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
                            <div class="row justify-content-center mb-10-none">
                                <div class="col-lg-12 form-group">
                                    <input type="text" class="form--control" placeholder="@lang('Email address')"
                                        name="email_from" value="{{ $general->email_from }}" required readonly>
                                </div>
                                {{-- <div class="col-lg-12 form-group">
                                    <textarea  class="form--control" name="email_template" placeholder="@lang('Your email template')" readonly>{{ $general->email_template }}</textarea>
                                </div> --}}
                            </div>
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
    {{-- Ck-editor js --}}
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
@endpush
