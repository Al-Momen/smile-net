
@extends('admin.layout.master')
@section('title')
    Home Manage Site
@endsection
@section('page-name')
    Home Manage Site
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
                <span class="active-path g-color">Home Manage Site</span>
            </a>
        </div>
        <div class="view-prodact">
            <a data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="las la-plus"></i>
                <span>Home Manage Site</span>
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
            <!-- Button trigger modal -->
            <div>

                <div>
                    <table class="table text-white rounded mt-5">
                        <thead class="text-center">
                            <tr>
                                <th scope="col" >Pages</th>
                                <th scope="col">Image</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @if ($allSiteImages->count() == 0)
                                <tr>
                                    <td colspan="99">No data found</td>
                                </tr>
                            @endif
                            @foreach ($allSiteImages as $item)
                                
                                    <tr>
                                        <td class="text-capitalize">{{ $item->manageSite->pages }}</td>
                                        <td><img class="table-user-img img-fluid d-block mx-auto"
                                                src="{{ asset('core\storage\app\public\manage-site\\' . $item->image) }}"
                                                alt="Image"></td>
                                        <td>
                                            <form action="{{ route('admin.manage.site.status.edit', $item->id) }}" method="POST">
                                                @csrf
                                                <label class="switch" id="switch">
                                                    <input type="checkbox" name="status"
                                                        @if ($item->status == 1) checked @endif id="switchInput">
                                                    <span class="slider round"></span>
                                                </label>
                                            </form>
                                        </td>
                                        <td>
                                            <a
                                                href="{{ route('admin.destroy.manage.site', $item->id) }}"class="btn btn-danger rounded"><i
                                                    class="fas fa-trash"></i></a>
                                            <a href="{{ route('admin.edit.manage.site', $item->id) }}"
                                                class="btn btn-primary rounded">
                                                <i class="fas fa-edit"></i></a>
                                        </td>
                                    </tr>
                            @endforeach
                        </tbody>
                    </table>
                 
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('admin.store.manage.site') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="modal-content">
                            <div class="modal-header bg--primary">
                                <h5 class="modal-title text-white">@lang('Add Title')</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row g-4k" style="padding: 20px;">
                                    <div class="mb-3 col-lg-6 col-md-6 col-12 pe-4">
                                        <label for="pages" class="form-label">@lang('Pages')</label>
                                        <select class="form-select form-select-md mb-3 text-capitalize"
                                            style="padding: 12px 10px;" aria-label=".form-select-lg example"
                                            name="pages">
                                            <option value=""> -- </option>
                                            @foreach ($pages as $page)
                                                <option @if ($page->id)  @endif
                                                    value="{{ $page->id }}">
                                                    {{ $page->pages }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3 col-lg-6 col-md-6 col-12 pe-4">
                                        <label for="image" class="form-label">@lang('Image') </label>
                                        <input type="file" src="" class="form-control px-3 pt-2"
                                            name="image" accept="image/*" id="image">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
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
