@extends('admin.layout.master')
@section('title')
    All-Events
@endsection
@section('page-name')
    All-Events
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
                <span class="active-path g-color">All-Books</span>
            </a>
        </div>
        <div class="view-prodact">
            
        </div>
    </div>
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
            <strong>{{ session('success') }}!</strong> <button type="button" class="btn-close" data-bs-dismiss="alert"
                aria-label="Close"></button>
        </div>
    @endif

    <form class="form-dashboard" action="{{ route('admin.update.book', $book->id) }}"method="POST"
        enctype="multipart/form-data" id="addEventForm">
        @csrf
        <div class="errMsgContainer" style="padding: 20px;">
        </div>
        <div class="row g-4k" style="padding: 20px;">
            <h5 class="modal-title mb-4" id="addModalLabel">Books Update</h5>
            <div class=" col-lg-6 col-md-6 col-12 pe-4">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" placeholder="Title" name="title" id="title"
                    value="{{ $book->title }}">
            </div>
            <div class=" col-lg-6 col-md-6 col-12 ">
                <label for="doller-input" class="form-label"> Price</label>
                <div class="input-group ">
                    <span class="input-group-text" style="
                        border-top-left-radius: 5px;border-bottom-left-radius:5px;">{{ $price->symbol }}</span>
                    <input type="number" class="form-control" min ="0" id="doller-input" placeholder="Price" name="price" value="{{ $book->price }}" required>
                  </div>
            </div>
            <div class="mb-3 mt-4 col-lg-6 col-md-6 col-12 pe-4">
                <label for="categoty" class="form-label">Category</label>
                <select class="form-select form-select-md mb-3" style="padding: 12px 10px;"
                    aria-label=".form-select-lg example" name="category">
                    <option value=""> -- </option>
                    @foreach ($categories as $category)
                        <option @if ($book->category_id == $category->id) selected @endif value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3 mt-4 col-lg-6 col-md-6 col-12 pe-4" style="display:none">
                <label for="tag" class="form-label">price_id</label>
                <input type="text" src="" class="form-control px-3 pt-2" name="price_id"
                    id="tag" placeholder="Tag" value="{{ $price->id }}" >
            </div>
            <div class="mb-3 mt-4 col-lg-6 col-md-6 col-12 pe-4">
                <label for="image" class="form-label">Image</label>
                <input type="file" src="" class="form-control px-3 pt-2" name="image" accept="image/*"
                    id="image">
            </div>
            <div class="mb-3  mt-4 col-lg-6 col-md-6 col-12 pe-4">
                <label for="file" class="form-label">File</label>
                <input type="file" src="" class="form-control px-3 pt-2" name="file"
                    accept="" id="file">
            </div>
            <div class="mb-3  mt-4 col-lg-6 col-md-6 col-12 pe-4">
                <label for="tag" class="form-label">Tag</label>
                <input type="text" src="" class="form-control px-3 pt-2" name="tag" id="tag" placeholder="Tag" value="{{ $book->tag }}">
            </div>
            <div class="mb-4 mt-4 col-lg-12 col-md-12 col-12 pe-4">
                <label for="editor" class="form-label">Description</label>
                <textarea id="editor" name="description" rows="5" class="form-control" value="">{{ $book->description }}</textarea>
            </div>
            <div class="text-center" style="margin: auto;">
                <button type="submit" style="width: 440px;" class="btn btn-primary " id="btn_add">Update</button>
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
