@extends('admin.layout.master')
@section('title')
    Author-wall
@endsection
@section('page-name')
    Author-wall
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
                <span class="active-path g-color">Edit Author-wall</span>
            </a>
        </div>
        <div class="view-prodact">
            
        </div>
    </div>

    <!-- Modal -->

    <form action="{{ route('admin.update.news', $news->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="user-info-header two mb-4">
            <h6 class="title">@lang('Edit Wall')</h6>
        </div>
        <div class="dashboard-form-area two mt-10">
            <div class="row g-4k" style="padding: 20px;">
                <div class=" col-lg-6 col-md-6 col-12 form-group">
                    <label for="title">@lang('Title')</label>
                    <input type="text" class="form--control" placeholder="Title" name="title" id="title"
                        value="{{ $news->title }}">
                </div>

                <div class="mb-3 col-lg-6 col-md-6 col-12 form-group">
                    <label for="categoty">Category</label>
                    <select class="form--control" style="padding: 12px 10px;" aria-label=".form-select-lg example"
                        name="category">
                        <option value=""> -- </option>
                        @foreach ($categories as $category)
                            <option @if ($news->category_id == $category->id) selected @endif value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-6 col-md-6 col-12 form-group">
                    <label for="image">@lang('Image')</label>
                    <input type="file" src="" class="form--control img-height" name="image" accept="image/*"
                        id="image">
                </div>

                <div class="col-lg-6 col-md-6 col-12 form-group">
                    <label for="tag">@lang('Tag')</label>
                    <input type="text" src="" class="form--control px-3 pt-2" name="tag" id="tag"
                        placeholder="@lang('Tag')" value="{{ $news->tag }}">
                </div>

                <div class="mt-col-lg-12 col-md-12 col-12 form-group">
                    <label for="editor">@lang('Description')</label>
                    <textarea id="editor" name="description" rows="5" class="form--control" value="">{{ $news->description }}</textarea>
                </div>
                <div class="col-lg-12 text-end">
                    <div class="edit-top-btn text-end ms-1">
                        <button type="submit" class="btn--base">Update</button>
                        <a href="{{ route('admin.news.index') }}" class="btn--base bg-danger d-inline-flex">Close</a>
                    </div>
                </div>

            </div>
        </div>
        
    </form>
@endsection
@section('css')
    <style>
        .img-height {
            line-height: 35px;
        }

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
