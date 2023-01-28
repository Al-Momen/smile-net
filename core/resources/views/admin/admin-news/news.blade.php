@extends('admin.layout.master')
@section('title')
    Author-walls
@endsection
@section('page-name')
    Author-walls
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
                <span class="active-path g-color">Author-walls</span>
            </a>
        </div>
        <div class="view-prodact">
            <a data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="las la-plus"></i>
                <span>Author-walls</span>
            </a>
        </div>
    </div>


    <!-- Button trigger modal -->
    <div class="table-content">

        <div class="table-wrapper table-responsive">
            <table class="custom-table table text-white rounded mt-5 ">
                <thead class="text-center" style="color:#7b8191">
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Category Name</th>
                        <th scope="col">Image</th>
                        {{-- <th scope="col">Status</th> --}}
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody class="text-center" style="color:#7b8191">
                    @if ($allNews->count() == 0)
                        <tr>
                            <td colspan="99" class="text-center">No data found</td>
                        </tr>
                    @endif
                    @foreach ($allNews as $news)
                        <tr>
                            <td>{{ $news->title }}</td>
                            <td>{{ $news->category->name }}</td>
                            <td><img class="table-user-img img-fluid d-block me-auto"
                                    src="{{ asset('core\storage\app\public\news\\' . $news->image) }}" alt="Image"></td>
                            {{-- <td>
                                            <form action="{{ route('admin.news.status.edit', $news->id) }}" method="POST">
                                                @csrf
                                                <label class="switch" id="switch">
                                                    <input type="checkbox" name="status"
                                                        @if ($news->status == 1) checked @endif id="switchInput">
                                                    <span class="slider round"></span>
                                                </label>
                                            </form>
                                        </td> --}}
                            <td>
                                <a href="{{ route('admin.news.destroy', $news->id) }}"class="btn btn-danger rounded"><i
                                        class="fas fa-trash"></i></a>
                                <a href="{{ route('admin.edit.news', $news->id) }}" class="btn btn-primary rounded">
                                    <i class="fas fa-edit"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $allNews->links() }}
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">

            <form action="{{ route('admin.store.news') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="modal-content">
                        <div class="modal-header ">
                            <h5 class="modal-title text--base">@lang('Add Title')</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-4k" style="padding: 0px 20px;">
                                <div class=" col-lg-6 col-md-6 col-12 form-group">
                                    <label for="title">@lang('Title')</label>
                                    <input type="text" class="form--control" placeholder="Title" name="title"
                                        id="title" value="">
                                </div>

                                <div class="mb-3 col-lg-6 col-md-6 col-12 form-group">
                                    <label for="categoty">@lang('Category')</label>
                                    <select class="form--control text-capitalize" style="padding: 12px 10px;"
                                        aria-label=".form-select-lg example" name="category">
                                        <option value=""> -- </option>
                                        @foreach ($categories as $category)
                                            <option @if ($category->id)  @endif value="{{ $category->id }}">
                                                {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class=" col-lg-6 col-md-6 col-12 form-group">
                                    <label for="image">@lang('Image') </label>
                                    <input type="file" src="" class="form--control" name="image"
                                        accept="image/*" id="image">
                                </div>

                                <div class="col-lg-6 col-md-6 col-12 form-group">
                                    <label for="tag">@lang('Tag')</label>
                                    <input type="text" src="" class="form--control px-3 pt-2" name="tag"
                                        id="tag" placeholder="@lang('Tag')">
                                </div>

                                <div class="col-lg-12 col-md-12 col-12 form-group">
                                    <label for="editor">@lang('Description')</label>
                                    <textarea id="editor" name="description" rows="5" class="form--control" value=""></textarea>
                                </div>
                                <div class="text-end mb-3">
                                    <button type="submit" class="btn--base">Save</button>
                                    <button type="button" class="btn--base bg-danger" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
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
