@extends('admin.layout.master')
@section('title')
    All Video Music
@endsection
@section('page-name')
    All Video Music
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
            <span class="active-path g-color">Edit Video-song</span>
        </a>
    </div>
    <div class="view-prodact">
       
    </div>
</div>

    <form action="{{ route('admin.update.video.music', $videoMusic->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="user-info-header two mb-4">
            <h5 class="modal-title text-white">@lang('Edit Song')</h5>

        </div>
        <div class="dashboard-form-area two mt-10">
            <div class="row g-4k" style="padding: 20px;">
                <div class=" col-lg-6 col-md-6 col-12 form-group">
                    <label for="title">@lang('Song Title')</label>
                    <input type="text" class="form--control" placeholder="Title" name="title" id="title"
                        value="{{ $videoMusic->title }}" required>
                </div>
                <div class=" col-lg-6 col-md-6 col-12 form-group">
                    <label for="file">@lang('Artist')</label>
                    <input type="text" class="form--control" placeholder="Song Name Artist" name="artist" id="file"
                        value="{{ $videoMusic->artist }}" required>
                </div>
                <div class=" col-lg-6 col-md-6 col-12 form-group">
                    <label for="singer_name">@lang('Singer Name')</label>
                    <input type="text" class="form--control" placeholder="Singer Name" name="singer_name"
                        id="singer_name" value="{{ $videoMusic->singer_name }}" required>
                </div>
                {{-- <div class="mb-3 mt-4 col-lg-6 col-md-6 col-12 form-group">
                            <label for="date">Date</label>
                            <input type="datetime-local" class="form-control" placeholder="Date" name="date" value="{{ $music->date }}"
                                id="date" required>
                        </div> --}}
                <div class="col-lg-6 col-md-6 col-12 form-group">
                    <label for="">@lang('Thumbnail') </label>
                    <input type="file" src="" class="form--control " name="image" accept="image/*"
                        id="thumbnail">
                </div>

                <div class="col-12 form-group">
                    <label for="">@lang('Video Music')</label>
                    <input type="file" src="" class="form--control " name="mp4" accept="video/*,.mkv"
                        id="mp4">
                </div>
                <div class="col-lg-12 text-end">
                    <button type="submit" class="btn--base">Update</button>
                    <button type="button" class="btn--base bg-danger"><a
                            href="{{ route('admin.video.music.index') }}">Back</a></button>
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
