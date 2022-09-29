@extends('frontend.deshboard.master')
@section('content')
    <div class="table-content">
        <div class="header-title">
            <div class="row g-5 pt-3">
                <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                    <div class="dashbord-user">
                        <div class="dashboard-content">
                            <div class="user-count">
                                <span class="text-uppercase">Active</span>
                            </div>
                            <div class="title pt-3">
                                <span>{{ $general_count }} events</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                    <div class="dashbord-user">
                        <div class="dashboard-content">
                            <div class="user-count">
                                <span class="text-uppercase">Pending</span>
                            </div>
                            <div class="title pt-3">
                                <span>1 Order</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                    <div class="dashbord-user">
                        <div class="dashboard-content">
                            <div class="user-count">
                                <span class="text-uppercase">Sold Out</span>
                            </div>
                            <div class="title pt-3">
                                <span>3 Order</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                    <div class="dashbord-user">
                        <div class="dashboard-content">
                            <div class="user-count">
                                <span class="text-uppercase">total</span>
                            </div>
                            <div class="title pt-3">
                                <span>{{ $general_count }} Events</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
            <!-- Button trigger modal -->
            <div class="text-end">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                    Add Events
                </button>
            </div>
            <div>
                <h3 class="text-white text-capitalize fw-bold pt-5 pb-3">Events</h3>
                <div>
                    <table class="table text-white rounded">
                        <thead>
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col">Start Date</th>
                                <th scope="col">End Date</th>
                                <th scope="col">Total Seat</th>
                                <th scope="col">Available Seat</th>
                                <th scope="col">Remain Seat</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach ($general_events as $event)
                            <tr>
                                <td>{{ $event->title }}</td>
                                <td>
                                    @php
                                        $date = $event->start_date;
                                        echo date('d/m/Y , h:i a ', strtotime($date));
                                    @endphp
                                </td>
                                <td>
                                    @php
                                        $date = $event->end_date;
                                        echo date('d/m/Y , h:i a ', strtotime($date));
                                        
                                    @endphp
                                </td>
                                <td>{{ $event->total_seat }}</td>
                                <td>{{ $event->title }}</td>
                                <td>{{ $event->title }}</td>
                                <td class="">
                                    <a href="{{ route('user.destroy.events', $event->id) }}"><i
                                            class="fa-solid fa-trash-can btn btn-danger rounded">
                                        </i></a>
                                    <a href="{{ route('user.edit.events', $event->id) }}"> <i
                                            class="fa-solid fa-edit btn btn-primary rounded" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal">
                                        </i></a>
                                </td>
                            </tr>
                            @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="addModalLabel" aria-hidden="true">
        <form class="form-dashboard" action="{{ route('user.store.events') }}" method="POST" enctype="multipart/form-data"
            id="addEventForm">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content" style="background-color: white!important;">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Events Add</h5>
                        <button type="button" class="btn-close" id="cross_close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="errMsgContainer" style="padding: 20px;">

                        </div>
                        <div class="row g-4k" style="padding: 20px;">
                            <div class=" col-lg-6 col-md-6 col-12 pe-4">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" placeholder="Title" name="title" id="title"
                                    value="">
                            </div>
                            <div class="mb-3 col-lg-6 col-md-6 col-12 pe-4">
                                <label for="total_seat" class="form-label">Tags</label>
                                <input type="number" class="form-control" placeholder="Total Sit" name="total_seat"
                                    id="total_seat" required>
                            </div>

                            <div class="mb-3 mt-4 col-lg-6 col-md-6 col-12 pe-4">
                                <label for="start_date" class="form-label">Start Date</label>
                                <input type="datetime-local" class="form-control" placeholder="Start Date"
                                    name="start_date" id="start_date" required>
                            </div>
                            <div class="mb-3 mt-4 col-lg-6 col-md-6 col-12 pe-4">
                                <label for="end_date" class="form-label">End Date</label>
                                <input type="datetime-local" class="form-control" placeholder="End Date" name="end_date"
                                    id="end_date" required>
                            </div>

                            <div class="mb-3 mt-4 col-lg-6 col-md-6 col-12 pe-4">
                                <label for="categoty" class="form-label">Category</label>
                                <select class="form-select form-select-md mb-3" style="padding: 12px 10px;"
                                    aria-label=".form-select-lg example" name="category">
                                    <option value="1" selected>Japan</option>
                                    <option value="2">Germany</option>
                                    <option value="3">Switzerland</option>
                                    <option value="4">Canada</option>
                                </select>
                            </div>

                            <div class="mb-3 mt-4 col-lg-6 col-md-6 col-12 pe-4">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" src="" class="form-control px-3 pt-2" name="image"
                                    accept="image/*" id="image">
                            </div>
                            <div class="mb-4 mt-4 col-lg-12 col-md-12 col-12 pe-4">
                                <label for="editor" class="form-label">Description</label>
                                <textarea id="editor" name="description" rows="5" class="form-control" value=""></textarea>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                                id="btn_close">Close</button>
                            <button type="submit" class="btn btn-primary" id="btn_add">Add</button>

                        </div> <!-- Button trigger modal -->
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
@endpush
@push('css')
    <style>
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

        /* Ck-editor css */
        .ck-blurred {
            height: 200px !important;
        }

        .ck-rounded-corners .ck.ck-editor__main>.ck-editor__editable,
        .ck.ck-editor__main>.ck-editor__editable.ck-rounded-corners {
            height: 200px;
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
@endpush
@push('js')
    {{-- Ck-editor js --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
    {{-- <script>
        $("#btn_close").click(function(e) {
            var descriptionData = editor.getData();
            editor.setData("");
            $('#addEventForm')[0].reset();
        });
        $("#cross_close").click(function(e) {
            var descriptionData = editor.getData();
            editor.setData("");
            $('#addEventForm')[0].reset();
        });
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).on("submit", "form#addEventForm", function(event) {
                event.preventDefault();
                $.ajax({
                    url: "{{ route('user.store.events') }}",
                    method: "POST",
                    data: new FormData(this),
                    dataType: 'JSON',
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        console.log(res);
                        if (res.status == "success") {
                            $('#addModal').modal('hide');
                            $('#addEventForm').trigger("reset");
                            editor.setData("");
                            $('.table').load(location.href + ' .table');
                            "use strict";
                            toastr.success(res.message);
                            
                        }
                    },
                    error: function(err) {
                        let error = err.responseJSON;
                        $.each(error.errors, function(index, value) {
                            $('.errMsgContainer').append('<span class="text-danger">' +
                                value +
                                '</span>' + '</br>');
                        });
                    }
                });

            });
        });
    </script> --}}
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
@endpush
