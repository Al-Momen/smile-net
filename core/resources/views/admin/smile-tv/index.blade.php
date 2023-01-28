@extends('admin.layout.master')
@section('title')
    Smile-Tv
@endsection
@section('page-name')
    Smile-Tv
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
                <span class="active-path g-color">All Smile-Tv</span>
            </a>
        </div>
        <div class="view-prodact">
            <a data-bs-toggle="modal" data-bs-target="#addModal">
                <i class="las la-plus"></i>
                <span>Add Smile-Tv</span>
            </a>
        </div>
    </div>
    <div class="table-content">
        <div class="shadow-lg card-1 my-3">
            <div class="table-wrapper table-responsive">
                <table class="custom-table table text-white rounded mt-5 ">
                    <thead style="color:#7b8191">
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Title</th>
                            <th scope="col">Category</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-capitalize text-center" style="font-size: 14px;color:#7b8191">
                        @if ($allSmileTv->count() == 0)
                            <tr>
                                <td colspan="99" class="text-center">No data found</td>
                            </tr>
                        @endif
                        @foreach ($allSmileTv as $smileTv)
                            <tr>
                                <td>{{ $smileTv->name }}</td>
                                <td>{{ $smileTv->title }}</td>
                                <td>{{ optional($smileTv->category)->name ?? 'N/A' }}</td>
                                <td>
                                    <form action="{{ route('admin.smile.tv.status.edit', $smileTv->id) }}" method="POST">
                                        @csrf
                                        <label class="switch" id="switch">
                                            <input type="checkbox" name="status"
                                                @if ($smileTv->status == 1) checked @endif id="switchInput">
                                            <span class="slider round"></span>
                                        </label>
                                    </form>
                                </td>
                                <td class="">
                                    <a
                                        href="{{ route('admin.smile.tv.destroy', $smileTv->id) }}"class="btn btn-danger rounded"><i
                                            class="fas fa-trash"></i>
                                    </a>
                                    <a
                                        href="{{ route('admin.edit.smile.tv', $smileTv->id) }}"class="btn btn-primary rounded"><i
                                            class="fas fa-edit"></i>
                                    </a>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $allSmileTv->links() }}
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header ">
                    <h5 class="modal-title text-white">@lang('Add TV Show')</h5>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                </div>
                <form action="{{ route('admin.store.smile.tv') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row g-4k" style="padding: 0px 20px;">
                            <div class="col-lg-6 col-md-6 col-12 form-group">
                                <label for="title">@lang('Title')</label>
                                <input type="text" class="form--control" placeholder="Title" name="title"
                                    id="title" value="">
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 form-group">
                                <label for="name">@lang('Name')</label>
                                <input type="text" class="form--control" placeholder="Name" name="name" id="name"
                                    value="">
                            </div>

                            <div class=" col-lg-6 col-md-6 col-12 form-group">
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
                                <label>@lang('Date')</label>
                                <input class="form--control" type="datetime-local" name="date"
                                    placeholder="@lang('date')" required value="{{ old('date') }}">
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 form-group">
                                <label for="image">@lang('Image') </label>
                                <input type="file" src="" class="form--control" name="image" accept="image/*"
                                    id="image">
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 form-group">
                                <label for="smile_tv_link">@lang('Smile-Tv Link')</label>
                                <input type="text" class="form--control" placeholder="Smile-Tv Link"
                                    name="smile_tv_link" id="smile_tv_link" value="">
                            </div>
                            <div class=" col-lg-12 col-md-12 col-12 form-group">
                                <label for="">@lang('Video') </label>
                                <input type="file" src="" class="form--control" name="mp4"
                                    accept="video/*,.mkv" id="video">
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn--base bg-primary">Save</button>
                                <button type="button" class="btn--base bg-danger" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('.switch').click(function() {
            $(this).parents('form').submit();
        })
        $('#doller-input')
    </script>
    {{-- toastr --}}
    <script>
        @if (Session::has('success'))
            toastr.success("{{ session('success') }}")
        @endif
    </script>
@endsection

@section('css')
    <style>
        /* -----------------Modal css----------------- */
        .modal-header .btn-close {
            padding: 0.5rem 0.5rem;
            margin: 0.5rem 2.5rem -29.5rem auto;
            background-color: red !important;
            opacity: 1;
        }

        .modal-title {
            font-size: 20px;
        }

        .form-label {
            font-size: 15px;
        }

        /* ------------------font icon------------------ */
        .font-icon {
            font-size: 13px !important;
            height: 30px;
            padding: 6px !important;
        }

        /* -----------------Ck-editor css----------------- */
        .ck-blurred {
            height: 200px !important;
        }

        .ck-rounded-corners .ck.ck-editor__main>.ck-editor__editable,
        .ck.ck-editor__main>.ck-editor__editable.ck-rounded-corners {
            height: 200px;
        }


        /* --------------------style checkbox-------------------- */
        input[type=checkbox]+label {
            display: block;
            margin: 0.2em;
            cursor: pointer;
            padding: 0.2em;
        }

        input[type=checkbox] {
            display: none;
        }

        input[type=checkbox]+label:before {
            content: "\2714";
            border: 0.1em solid #000;
            border-radius: 0.2em;
            display: inline-block;
            width: 22px;
            height: 22px;
            padding-left: 5px;
            padding-bottom: 0.3em;
            margin-right: 1.2em;
            vertical-align: bottom;
            color: transparent;
            transition: .2s;
        }

        input[type=checkbox]+label:active:before {
            transform: scale(0);
        }

        input[type=checkbox]:checked+label:before {
            background-color: MediumSeaGreen;
            border-color: MediumSeaGreen;
            color: #fff;
        }

        input[type=checkbox]:disabled+label:before {
            transform: scale(1);
            border-color: #aaa;
        }

        input[type=checkbox]:checked:disabled+label:before {
            transform: scale(1);
            background-color: #bfb;
            border-color: #bfb;
        }

        /* -----------------------switch button css------------------------- */
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
