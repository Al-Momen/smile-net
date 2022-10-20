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

    <form class="form-dashboard" action="{{ route('user.update.books', $book->id) }}"method="POST"
        enctype="multipart/form-data" id="addEventForm">
        @csrf
        <div class="errMsgContainer" style="padding: 20px;">
        </div>
        <div class="row g-4k" style="padding: 20px; background-color:white;">
            <h5 class="modal-title mb-4" id="addModalLabel">Books Update</h5>
            <div class=" col-lg-6 col-md-6 col-12 pe-4">
                <label for="title" class="form-label">Title</label>
                <p>{!! $book->title !!}</p>
            </div>
            <div class=" col-lg-6 col-md-6 col-12 ">
                <label for="doller-input" class="form-label"> Price</label>
                <div class="input-group ">
                    <p>{!! $book->price !!}{!! $price->symbol !!}</p>
                </div>
            </div>

            <div class="mb-3 mt-4 col-lg-6 col-md-6 col-12 pe-4">
                <label for="categoty" class="form-label">Category</label>
                <p>{!! $book->category->name !!}</p>

            </div>
            <div class="mb-3  mt-4 col-lg-6 col-md-6 col-12 pe-4">
                <label for="tag" class="form-label">Tag</label>
                <p>{!! $book->tag !!}</p>
            </div>
            <div class="mb-3 mt-4 col-lg-12 col-md-12 col-12 pe-4">
                <label for="image" class="form-label"> Cover Image</label>
                <img src="{{ asset('core\storage\app\public\books\\' . $book->image) }}" alt="" style=" height: 230px;
                width: 300px; padding-left: 20px;">
            </div>

            <div class="mb-4 mt-4 col-lg-12 col-md-12 col-12 pe-4">
                <label for="doller-input" class="form-label">Description</label>
                <p>{!! $book->description !!}</p>
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
        p{
            padding-left: 28px;
        }
        .modal-header .btn-close {
            padding: 0.5rem 0.5rem;
            opacity: 1;
        }

        .modal-title {
            font-size: 20px;
        }

        .form-label {
            color: black !important;
            background-color: #2196F3;
            font-size: 17px;
            padding-left: 20px;   
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