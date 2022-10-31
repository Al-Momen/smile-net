@extends('admin.layout.master')
@section('title')
    All-News
@endsection
@section('page-name')
    All-News
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
                <span class="active-path g-color">All-News</span>
            </a>
        </div>
        <div class="view-prodact">
            <a >
                <i class="las la-plus"></i>
                <span>Add News</span>
            </a>
        </div>
    </div>
    <div class="table-content">
        <div class="shadow-lg p-4 card-1 my-3">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('success') }}!</strong> <button type="button" class="btn-close"
                        data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('danger'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ session('danger') }}!</strong> <button type="button" class="btn-close"
                        data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
    </div>
    <!-- Modal -->

    <form action="{{ route('admin.update.news',$news->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
            <div class="modal-content">
                <div class="modal-header bg--primary">
                    <h5 class="modal-title text-white">@lang('Edit News')</h5>
                </div>
                <div class="modal-body">
                    <div class="row g-4k" style="padding: 20px;">
                        <div class=" col-lg-6 col-md-6 col-12 pe-4">
                            <label for="title" class="form-label">@lang('Title')</label>
                            <input type="text" class="form-control" placeholder="Title" name="title" id="title"
                                value="{{$news->title}}">
                        </div>

                        <div class="mb-3 col-lg-6 col-md-6 col-12 pe-4">
                            <label for="categoty" class="form-label">Category</label>
                            <select class="form-select form-select-md mb-3" style="padding: 12px 10px;"
                                aria-label=".form-select-lg example" name="category">
                                <option value=""> -- </option>
                                @foreach ($categories as $category)
                                    <option @if ($news->category_id == $category->id) selected @endif value="{{ $category->id }}">
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 mt-4 col-lg-6 col-md-6 col-12 pe-4">
                            <label for="image" class="form-label">@lang('Image') </label>
                            <input type="file" src="" class="form-control px-3 pt-2" name="image"
                                accept="image/*" id="image">
                        </div>

                        <div class="mb-3 mt-4 col-lg-6 col-md-6 col-12 pe-4">
                            <label for="tag" class="form-label">@lang('Tag')</label>
                            <input type="text" src="" class="form-control px-3 pt-2" name="tag"
                                id="tag" placeholder="@lang('Tag')" value="{{$news->tag}}">
                        </div>
                       
                        <div class="mb-4 mt-4 col-lg-12 col-md-12 col-12 pe-4">
                            <label for="editor" class="form-label">@lang('Description')</label>
                            <textarea id="editor" name="description" rows="5" class="form-control" value="">{{$news->description}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
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
