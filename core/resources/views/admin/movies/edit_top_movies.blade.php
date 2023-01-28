@extends('admin.layout.master')
@section('title')
    Edit New Top Movies
@endsection
@section('page-name')
    Edit New Top Movies
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
                <span class="active-path g-color"> Edit Top Movies</span>
            </a>
        </div>
        <div class="view-prodact">

        </div>
    </div>

    <form action="{{ route('admin.update.top.movies', $topMovies->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="user-info-header two">
            <h5 class="title">@lang('Edit Top Movies')</h5>
        </div>
        <div class="dashboard-form-area two mt-10">
            <div class="row g-4k" style="padding: 20px;">
                <div class="col-lg-6 col-md-6 col-12 form-group">
                    <label for="name">@lang('Name')</label>
                    <input type="text" class="form--control" placeholder="Name" name="name" id="name"
                        value="{{ $topMovies->name }}">
                </div>
                <div class="col-lg-6 col-md-6 col-12 form-group">
                    <label for="title">@lang('Category')</label>
                    <input type="text" class="form--control" placeholder="Category" name="category" id="title"
                        value="{{ $topMovies->category }}">
                </div>

                <div class="col-lg-6 col-md-6 col-12 form-group">
                    <label for="ticket_type">@lang('Ticket Type')</label>
                    <select class="form--control text-capitalize">
                        <option value=""> -- </option>
                        @foreach ($ticketTypes as $ticketType)
                            <option @if ($ticketType->id == $topMovies->ticket_type_id) selected @endif value="{{ $ticketType->id }}">
                                {{ $ticketType->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-6 col-md-6 col-12 form-group">
                    <label>@lang('Image') </label>
                    <input type="file" src="" class="form--control" name="image"
                        accept="image/*" id="image">
                </div>
                <div class="col-12 form-group">
                    <label for="" class="form-label">@lang('Movies') </label>
                    <input type="file" src="" class="form--control" name="mp4"
                        accept="video/*,.mkv" id="mp4">
                </div>

                <div class="col-lg-12 col-md-6 col-12 form-group">
                    <label for="editor">@lang('Description')</label>
                    <textarea id="editor" name="description" rows="5" class="form-control" value="">{!! $topMovies->description !!}</textarea>
                </div>
                <div class="col-lg-12">
                    <div class="edit-top-btn d-flex justify-content-end">
                        <button type="submit" class="btn--base">Update</button>
                        <a href="{{route('admin.home.top.movies')}}" class="btn--base bg-danger ms-1" data-bs-dismiss="modal">Close</a>
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
