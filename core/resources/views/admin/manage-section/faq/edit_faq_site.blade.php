@extends('admin.layout.master')
@section('title')
    Edit FAQ
@endsection
@section('page-name')
    Edit FAQ
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
            <a href="#">
                <span class="active-path g-color"> Edit FAQ </span>
            </a>
        </div>
        <div class="view-prodact">

        </div>
    </div>
    <!-- Modal -->

    <form action="{{ route('admin.faq.update', $faq->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text--base">@lang('Edit FAQ ')</h5>
                </div>
                <div class="modal-body">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="row g-4k" style="padding: 0px 20px;">
                                <div class=" col-lg-12 col-md-12 col-12 form-group">
                                    <label for="title">@lang('Question')</label>
                                    <input type="text" class="form--control" placeholder="question" name="question"
                                        id="title" value="{{ $faq->question }}">
                                </div>

                                <div class="col-lg-12 col-md-12 col-12 form-group">
                                    <label for="editor">@lang('Ans')</label>
                                    <textarea id="editor" name="ans" rows="5" class="form--control" value="">{{ $faq->ans }}</textarea>
                                </div>
                                <div class="col-lg-12 form-group">
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn--base me-2">Update</button>
                                        <a href="{{ route('admin.faq.index') }}" class="btn--base bg-danger">Close</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('css')
    <style>
        .table-user-img {
            height: 60px;
            width: 60px;
            border-radius: 70px;
        }

        .modal-header .btn-close {
            padding: 0.5rem 0.5rem;
            opacity: 1;
        }

        .modal-title {
            font-size: 20px;
        }

        .form-label {
            font-size: 15px;
        }

        /* Ck-editor css */
        .ck-blurred {
            height: 300px !important;
        }

        .ck-rounded-corners .ck.ck-editor__main>.ck-editor__editable,
        .ck.ck-editor__main>.ck-editor__editable.ck-rounded-corners {
            height: 300px;
        }

        /* switch button css */
        .switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 23px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked+.slider {
            background-color: #2196F3;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>
@endsection

@section('scripts')
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
@endsection
