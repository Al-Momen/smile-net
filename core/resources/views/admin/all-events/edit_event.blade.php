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
                <span class="active-path g-color">Edit-Events</span>
            </a>
        </div>
        <div class="view-prodact">


        </div>
    </div>

    <form class="form-dashboard" action="{{ route('admin.event.update', $event->id) }}"method="POST"
        enctype="multipart/form-data" id="addEventForm">
        @csrf
        <div class="user-info-header two ">
            <h6 class="title">@lang('Events Update')</h6>
        </div>

        <div class="row g-4k" style="padding: 20px;">
            <div class=" col-lg-6 col-md-6 col-12 form-group">
                <label for="title">Title</label>
                <input type="text" class="form--control" placeholder="Title" name="title" id="title"
                    value="{{ $event->title }}">
            </div>
            <div class="col-lg-6 col-md-6 col-12 form-group">
                <label for="start_date">Start Date</label>
                <input type="date" class="form--control" placeholder="Start Date" name="start_date" id="start_date"
                    value="{{ $event->start_date }}" required>
            </div>
            <div class="col-lg-6 col-md-6 col-12 form-group">
                <label for="end_date">End Date</label>
                <input type="date" class="form--control" placeholder="End Date" name="end_date" id="end_date"
                    value="{{ $event->end_date }}" required>
            </div>

            <div class="col-lg-6 col-md-6 col-12 form-group">
                <label for="categoty">Category</label>
                <select class="form--control" style="padding: 12px 10px;"
                    aria-label=".form-select-lg example" name="category">
                    <option value=""> -- </option>
                    @foreach ($categories as $category)
                        <option @if ($event->category_id == $category->id) selected @endif value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-6 col-md-6 col-12 form-group checkbox-block">
                @foreach ($event->eventPlans as $item)
                    <div class="single-checkbox">
                        <input class="checkboxInput form--control" type="checkbox" id="{{ $item->ticketType->name }}"
                            name="ticket_type_id[]" value="{{ $item->ticket_type_id }}" data-bs-toggle="collapse"
                            data-bs-target="#{{ $item->ticketType->name }}" aria-expanded="true" aria-controls="collapse"
                            @if ($item->ticket_type_id) checked @endif>
                        <label for="{{ $item->ticketType->name }}"
                            class="text-capitalize">{{ $item->ticketType->name }}</label>
                        <div class="collapse show" id="{{ $item->ticketType->name }}">
                            <label for="basic">Seat</label>
                            <input type="number" name="seat[]" placeholder="Enter your Seat" class="form--control" value="{{ $item->seat }}">
                            <label for="basic">Price</label>
                            <div class="input-group mb-3 mt-3">
                                <span class="input-group-text"
                                    style="
                                                    border-top-left-radius: 5px;border-bottom-left-radius:5px;">{{ $priceCurrency->symbol }}</span>
                                <input class="d-none" type="text" class="form--control" name="price_currency_id"
                                    value="{{ $priceCurrency->id }}">
                                <input type="number" class="form--control" min="0" id="doller-input"
                                    placeholder="Enter your {{ $item->name }} Price" name="price[]"
                                    value="{{ $item->price }}">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-lg-6 col-md-6 col-12 form-group">
                <label for="">Image</label>
                <input type="file" src="" class="form--control" name="image" accept="image/*"
                    id="image">
            </div>
            <div class=" col-lg-12 col-md-12 col-12 form-group">
                <label for="editor">Description</label>
                <textarea id="editor" name="description" rows="5" class="form--control">{{ $event->description }}</textarea>

            </div>
            <div class="text-center" style="margin: auto;">
                <button type="submit" style="width: 440px;" class="btn btn--base bg-primary " id="btn_add">Update</button>
            </div>
        </div>
    </form>

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
