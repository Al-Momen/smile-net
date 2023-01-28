@extends('admin.layout.master')
@section('title')
    Manage Site
@endsection
@section('page-name')
    Manage Site
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
                <span class="active-path g-color"> Manage Site</span>
            </a>
        </div>
        <div class="view-prodact">
            
        </div>
    </div>
    <!-- Modal -->

    <form action="{{ route('admin.update.manage.site', $siteImage->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
            <div class="modal-content">
                <div class="modal-header ">
                    <h5 class="modal-title text--base">@lang('Edit Manage Site')</h5>
                </div>
                <div class="modal-body">
                    <div class="row g-4k" style="padding: 20px;">
                        <div class="col-lg-6 col-md-6 col-12 form-group">
                            <label for="pages">@lang('Pages')</label>
                            <select class="form--control text-capitalize" style="padding: 12px 10px;"
                                aria-label=".form-select-lg example" name="pages">
                                <option value=""> -- </option>
                                @foreach ($pages as $page)
                                    <option @if ($page->id == $siteImage->manage_site_id) selected @endif value="{{ $page->id }}">
                                        {{ $page->pages }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 form-group">
                            <label for="image">@lang('Image') </label>
                            <input type="file" src="" class="form--control" name="image" accept="image/*"
                                id="image">
                        </div>
                        <div class="col-12 form-group d-flex justify-content-end">
                            <button type="submit" class="btn--base bg-primary me-2">Update</button>
                            <a href="{{route('admin.manage.site')}}" class="btn--base bg-danger" data-bs-dismiss="modal">Close</a>
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
