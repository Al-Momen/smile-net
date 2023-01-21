@extends('admin.layout.master')
@section('title')
    All-Music
@endsection
@section('page-name')
    All-Music
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
                <span class="active-path g-color">All-Music</span>
            </a>
        </div>
        <div class="view-prodact">
            <a data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="las la-plus"></i>
                <span>Add Music</span>
            </a>
        </div>
    </div>
    <div class="table-content">
        <div class="shadow-lg card-1 my-3">
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
            <!-- Button trigger modal -->
            <div class="table-content">
                <div class="shadow-lg card-1 my-3">
                    <div class="table-wrapper table-responsive">
                        <table class="custom-table table text-white rounded mt-5 ">
                        <thead class="text-center" style="color:#7b8191">
                            <tr>
                                <th scope="col">Song Title</th>
                                <th scope="col">Artist Name</th>
                                <th scope="col">Date</th>
                                <th scope="col">Thumbnail</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-center" style="color:#7b8191">
                            @if ($allMusic->count() == 0)
                                <tr>
                                    <td colspan="99" class="text-center">No data found</td>
                                </tr>
                            @endif
                            @foreach ($allMusic as $music)
                                <tr>
                                    <td>{{ $music->title }}</td>
                                    <td>{{ $music->artist }}</td>
                                    <td>
                                        @php
                                            $date = $music->created_at;
                                            echo date('d/m/Y , h:i a ', strtotime($date));
                                        @endphp
                                    </td>
                                    <td>
                                        <img class="table-user-img img-fluid d-block mx-auto"
                                            src="{{ asset('core\storage\app\public\music\photo\\' . $music->image) }}"
                                            alt="Image">
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.status.edit', $music->id) }}" method="POST">
                                            @csrf
                                            <label class="switch" id="switch">
                                                <input type="checkbox" name="status"
                                                    @if ($music->status == 1) checked @endif id="switchInput">
                                                <span class="slider round"></span>
                                            </label>
                                        </form>
                                    </td>
                                    <td>
                                        <a
                                            href="{{ route('admin.music.destroy', $music->id) }}"class="btn btn-danger rounded"><i
                                            class="fas fa-trash"></i></a>
                                        <a href="{{ route('admin.edit.music', $music->id) }}"
                                            class="btn btn-primary rounded">
                                            <i class="fas fa-edit" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $allMusic->links() }}
                </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal audio music-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('admin.store.music') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="modal-content">
                            <div class="modal-header bg--primary">
                                <h5 class="modal-title text-white">@lang('Add Song')</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row g-4k" style="padding: 20px;">
                                    <div class=" col-lg-6 col-md-6 col-12 pe-4">
                                        <label for="title" class="form-label">@lang('Song Name')</label>
                                        <input type="text" class="form-control" placeholder="Song Name" name="title"
                                            id="title" value="" required>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12 pe-4">
                                        <label for="artist" class="form-label">@lang('Artist Name')</label>
                                        <input type="text" class="form-control" placeholder="Song Artist Name " name="artist"
                                            id="artist" value="" required>
                                    </div>
                                    <div class="mb-3 mt-4 col-lg-6 col-md-6 col-12 pe-4">
                                        <label for="singer_name" class="form-label">@lang('Singer Name')</label>
                                        <input type="text" class="form-control" placeholder="Singer Name" name="singer_name"
                                            id="singer_name" value="" required>
                                    </div>
                                    {{-- <div class="mb-3 mt-4 col-lg-6 col-md-6 col-12 pe-4">
                                        <label for="date" class="form-label">Date</label>
                                        <input type="datetime-local" class="form-control" placeholder="Date"
                                            name="date" id="date" required>
                                    </div> --}}
                                    <div class="mb-3 mt-4 col-lg-6 col-md-6 col-12 pe-4">
                                        <label for="thumbnail" class="form-label">@lang('Thumbnail') </label>
                                        <input type="file" src="" class="form-control px-3 pt-2" name="image"
                                            accept="image/*" id="thumbnail" required>
                                    </div>

                                    <div class="mb-3 mt-4 col-lg-6 col-md-6 col-12 pe-4">
                                        <label for="audio" class="form-label">@lang('Audio File')</label>
                                        <input type="file" src="" class="form-control px-3 pt-2"
                                            name="mp3" accept="audio/*" id="audio">
                                    </div>
                                  
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
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
