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
                <span class="active-path g-color">All-Events</span>
            </a>
        </div>
        <div class="view-prodact">


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
                <form class="form-dashboard" action="{{ route('admin.event.update', $event->id) }}"method="POST"
                    enctype="multipart/form-data" id="addEventForm">
                    @csrf
                    <div class="errMsgContainer" style="padding: 20px;">

                    </div>

                    <div class="row g-4k" style="padding: 20px;">
                        <h5 class="modal-title mb-4" id="addModalLabel" style="color:#7b8191">Events Update</h5>
                        <div class=" col-lg-6 col-md-6 col-12 pe-4">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" placeholder="Title" name="title" id="title"
                                value="{{ $event->title }}">
                        </div>
                        <div class="mb-3  col-lg-6 col-md-6 col-12 pe-4">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="datetime-local" class="form-control" placeholder="Start Date" name="start_date"
                                id="start_date" value="{{ $event->start_date }}" required>
                        </div>
                        <div class="mb-3 mt-4 col-lg-6 col-md-6 col-12 pe-4">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="datetime-local" class="form-control" placeholder="End Date" name="end_date"
                                id="end_date" value="{{ $event->end_date }}" required>
                        </div>

                        <div class="mb-3 mt-4 col-lg-6 col-md-6 col-12 pe-4">
                            <label for="categoty" class="form-label">Category</label>
                            <select class="form-select form-select-md mb-3" style="padding: 12px 10px;"
                                aria-label=".form-select-lg example" name="category">
                                <option value=""> -- </option>
                                @foreach ($categories as $category)
                                    <option @if ($event->category_id == $category->id) selected @endif value="{{ $category->id }}">
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 mt-4 col-lg-6 col-md-6 col-12 pe-4 checkbox-block bg-white">
                            @foreach ($event->eventPlans as $item)
                                <div class="single-checkbox">
                                    <input class="checkboxInput" type="checkbox" id="{{ $item->ticketType->name }}"
                                        name="ticket_type_id[]" value="{{ $item->ticket_type_id }}"
                                        data-bs-toggle="collapse" data-bs-target="#{{ $item->ticketType->name }}"
                                        aria-expanded="true" aria-controls="collapse"
                                        @if ($item->ticket_type_id) checked @endif>
                                    <label for="{{ $item->ticketType->name }}"
                                        class="text-capitalize">{{ $item->ticketType->name }}</label>
                                    <div class="collapse show" id="{{ $item->ticketType->name }}">
                                        <label for="basic">Seat</label>
                                        <input type="number" name="seat[]" placeholder="Enter your Seat"
                                            value="{{ $item->seat }}">
                                        <label for="basic">Price</label>
                                        <div class="input-group mb-3 mt-3">
                                            <span class="input-group-text"
                                                style="
                                                    border-top-left-radius: 5px;border-bottom-left-radius:5px;">{{ $priceCurrency->symbol }}</span>
                                            <input class="d-none" type="text" name="price_currency_id"
                                                value="{{ $priceCurrency->id }}">
                                            <input type="number" class="form-control" min="0" id="doller-input"
                                                placeholder="Enter your {{ $item->name }} Price" name="price[]"
                                                value="{{ $item->price }}">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mb-3 mt-4 col-lg-6 col-md-6 col-12 pe-4">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" src="" class="form-control px-3 pt-2" name="image"
                                accept="image/*" id="image">
                        </div>
                        <div class="mb-4 mt-4 col-lg-12 col-md-12 col-12 pe-4">
                            <label for="editor" class="form-label">Description</label>
                            <textarea id="editor" name="description" rows="5" class="form-control">{{ $event->description }}</textarea>

                        </div>
                        <div class="text-center" style="margin: auto;">
                            <button type="submit" style="width: 440px;" class="btn btn-primary "
                                id="btn_add">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal -->
@endsection
@section('css')
    <style>
        .form-control {

            height: calc(2.3em + .75rem + 2px) !important;

        }

        .modal-title {
            font-size: 25px;
            color: white;
        }

        .form-label {
            font-size: 15px;
            color: aliceblue;
        }

        /* Ck-editor css */
        .ck-blurred {
            height: 350px !important;
        }

        .ck-rounded-corners .ck.ck-editor__main>.ck-editor__editable,
        .ck.ck-editor__main>.ck-editor__editable.ck-rounded-corners {
            height: 350px;
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

        /*------------------ switch button css------------------ */
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
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    {{-- Ck-editor js --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
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

    <script>
        $('.checkboxInput').on('change', function() {
            if ($(this).is(':checked') === false) {
                $(this).parents('.single-checkbox').find('input').val("");

                $(this).parents('.single-checkbox').find('input').attr('required', false);
            } else {
                $(this).parents('.single-checkbox').find('input').attr('required', true);
            }
        });
        $(document).ready(function() {
            var allCheckbox = $('.checkboxInput');
            $.each(allCheckbox, function(index, item) {
                // var inputItems = $(item).find('input');
                if ($(item).is(":checked") === false) {
                    console.log($(item));
                    $(item).parents('.single-checkbox').find('input').val("");
                    $(item).parents('.single-checkbox').find('input').attr('required', false);
                } else {
                    $(item).parents('.single-checkbox').find('input').attr('required', true);
                }
            });
        });
    </script>
@endsection
