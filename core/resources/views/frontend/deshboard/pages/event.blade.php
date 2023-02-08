@extends('frontend.deshboard.master')
@section('content')
    <div class="table-content">
        <div class="header-title">
            <div class="row g-5 pt-3">
                <div class="col-xl-4 col-lg-4 col-md-6 mb-20">
                    <div class="dashbord-user">
                        <div class="dashboard-content">
                            <div class="user-count">
                                <span class="text-uppercase">Active</span>
                            </div>
                            <div class="title pt-3">
                                <span>{{ $general_active_count }} Events</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6 mb-20">
                    <div class="dashbord-user">
                        <div class="dashboard-content">
                            <div class="user-count">
                                <span class="text-uppercase">Pending</span>
                            </div>
                            <div class="title pt-3">
                                <span>{{ $general_pending_count }} Events</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-6 mb-20">
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
            
            <!-- Button trigger modal -->
            <div class="text-end">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                    Add Events
                </button>
            </div>
            <div>
                <h3 class="text-white text-capitalize fw-bold pt-5 pb-3">Events</h3>
                <div class="table-responsive">
                    <table class="table text-white rounded text-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col">Start Date</th>
                                <th scope="col">End Date</th>
                                <th scope="col">Category</th>
                                <th scope="col">Status</th>
                                <th scope="col">Sold out</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-capitalize" style="font-size: 14px;">
                            
                                {{-- @if ($general_count == 0)
                            <tr>
                                <td colspan="99">No data found</td>
                            </tr>
                            @endif --}}
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
                                    <td>{{ optional($event->category)->name ?? 'N/A' }}</td>

                                    <td>
                                        @php
                                            if ($event->status == 1) {
                                                echo '<span class="badge bg-success">Active</span>';
                                            } else {
                                                echo '<span class="badge bg-danger">Pending</span>';
                                            }
                                        @endphp
                                    </td>
                                    <td class="">
                                        <a href="{{ route('user.sold.out.events', $event->id) }}"> <i
                                                class="fa-solid fa-eye btn btn-primary rounded font-icon">
                                            </i></a>
                                    </td>
                                    <td class="">
                                        <button class="fas fa-eye btn btn-primary rounded font-icon"
                                            data-event-details="{{ $event }}" id="event_details"></button>

                                        <a href="{{ route('user.edit.events', $event->id) }}"> <i
                                                class="fa-solid fa-edit btn btn-primary rounded font-icon">
                                            </i></a>
                                    </td>
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                    {{ $general_events->links() }}
                </div>
            </div>
        </div>
    </div>
    <!--Add Modal -->
    <div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="addModalLabel" aria-hidden="true">
        <form class="form-dashboard" action="{{ route('user.store.events') }}" method="POST" enctype="multipart/form-data"
            id="addEventForm">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content"
                    style="  background-image: linear-gradient(to right top, #15243b, #1a2137, #1e1f33, #201c2e, #211a2a);!important;">
                    <div class="modal-header">
                        <h5 class="modal-title text-white" id="addModalLabel">Events Add</h5>
                        <button type="button" class="btn-close" id="cross_close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="errMsgContainer" style="padding: 20px;">
                        </div>
                        <div class="row g-4k" style="padding: 20px;">
                            <div class=" col-lg-6 col-md-6 col-12 pe-4">
                                <label for="title" class="form-label text-white">Title</label>
                                <input type="text" class="form-control" placeholder="Title" name="title" id="title"
                                    value="">
                            </div>
                            <div class="mb-3  col-lg-6 col-md-6 col-12 pe-4">
                                <label for="start_date" class="form-label text-white">Start Date</label>
                                <input type="date" class="form-control" placeholder="Start Date" name="start_date"
                                    id="start_date" required>
                            </div>
                            <div class="mb-3 mt-4 col-lg-6 col-md-6 col-12 pe-4">
                                <label for="end_date" class="form-label text-white">End Date</label>
                                <input type="date" class="form-control" placeholder="End Date" name="end_date"
                                    id="end_date" required>
                            </div>

                            <div class=" mt-4 col-lg-6 col-md-6 col-12 pe-4">
                                <label for="categoty" class="form-label text-white">Category</label>
                                <select class="form-select form-select-md mb-3 text-capitalize"
                                    aria-label=".form-select-lg example" name="category">
                                    <option value=""> -- </option>
                                    @foreach ($categories as $category)
                                        <option @if ($category->id)  @endif value="{{ $category->id }}">
                                            {{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4 mt-4 col-lg-6 col-md-6 col-12 pe-4 checkbox-block">
                                @foreach ($ticketType as $item)
                                    <div class="single-checkbox">
                                        <input class="checkboxInput" type="checkbox" id="{{ $item->name }}"
                                            name="ticket_type_id[]" value="{{ $item->id }}"
                                            data-bs-toggle="collapse" data-bs-target="#{{ $item->name }}"
                                            aria-expanded="false" aria-controls="collapse">
                                        <label for="{{ $item->name }}"
                                            class="text-capitalize text-white">{{ $item->name }}</label>
                                        <div class="collapse" id="{{ $item->name }}">
                                            <label for="basic" class="text-white">Seat</label>
                                            <input type="number" name="seat[]"
                                                placeholder="Enter your {{ $item->name }} Seat">
                                            <label for="basic" class="text-white">Price</label>
                                            <div class="input-group mb-3 mt-3">
                                                <span class="input-group-text"
                                                    style="
                                                        border-top-left-radius: 5px;border-bottom-left-radius:5px;">{{ $priceCurrency->symbol }}</span>
                                                <input class="d-none" type="text" name="price_currency_id"
                                                    value="{{ $priceCurrency->id }}">
                                                <input type="number" class="form-control" min="0"
                                                    id="doller-input" placeholder="Enter your {{ $item->name }} Price"
                                                    name="price[]">
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="mb-4 mt-4 col-lg-6 col-md-6 col-12 pe-4">
                                <label for="image" class="form-label text-white">Image</label>
                                <input type="file" src="" class="form-control" name="image"
                                    accept="image/*" id="image" style="height: 40px !important; line-height: 27px;">
                            </div>

                            <div class="mb-3 mt-2 col-lg-12 col-md-12 col-12 pe-4">
                                <label for="editor" class="form-label text-white">Description</label>
                                <textarea id="editor" name="description" rows="5" class="form-control" value=""></textarea>
                            </div>
                        </div>
                        <div class="mb-4 me-4 d-flex justify-content-end">
                            <button type="button" class="btn btn-danger me-2" data-bs-dismiss="modal"
                                id="btn_close">Close</button>
                            <button type="submit" class="btn btn-primary" id="btn_add">Add</button>

                        </div> <!-- Button trigger modal -->
                    </div>
                </div>
            </div>
        </form>
    </div>

    {{-- View modal --}}
    <div class="modal fade" id="eventDetails" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="eventDetailsLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content" style="background-color: white!important;">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventDetailsLabel">Events View</h5>
                    <button type="button" class="btn-close" id="cross_close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body" id="event_description_modal">


                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                            id="btn_close">Close</button>
                    </div> <!-- Button trigger modal -->
                </div>
            </div>
        </div>
    </div>
@endsection

@push('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
@endpush
@push('css')
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
            border: 0.1em solid #fff;
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
    <script>
        $('.checkboxInput').change(function() {
            if ($(this).is(':checked') == false) {
                $(this).parents('.single-checkbox').find('input').val("");
            }
        });
    </script>

    {{-- model events view --}}
    <script>
        $(document).on('click', '#event_details', function(e) {
            var button = $(this);
            var button_data = button.data('event-details');
            console.log(button_data);
            var modal_body_description = $('#event_description_modal');
            var modal_body_title = $('span#events_title');
            // console.log(modal_body_title);
            modal_body_description.html('');

            // var image = {{ 'core/storage/app/public/events//' }} ;
            var image = "{{ url('/') }}" + '/core/storage/app/public/events/';
            console.log(image);

            var seat_details = button_data?.event_plans?.map(eventPlan => {

                return `
                                  ${eventPlan.ticket_type.name}:-
                                  ${eventPlan.seat}
                              `;

            });
            var price = button_data?.event_plans?.map(eventPlan => {
                return `
                                  ${eventPlan.ticket_type.name}:-
                                  ${eventPlan.price}
                                 
                              `;

            });
            var ticket_type = button_data?.event_plans?.map(eventPlan => {

                return `
                                  ${eventPlan.ticket_type.name}
                                 
                              `;

            });

            var eventStatus = '';
            if (button_data.status == 1) {
                eventStatus = 'Active';
            } else {
                eventStatus = 'Inactive';
            }
            modal_body_description.append(
                `
                    <div class="row g-4k" style="padding: 20px;">
                        <div class=" col-lg-6 col-md-6 col-12 pe-4" id="events_title">
                            <h4> Title</h4>
                            <span> ${button_data.title}</span>
                        </div>
                        <div class="mb-3  col-lg-6 col-md-6 col-12 pe-4">
                            <h4>Category</h4>
                            <span> ${button_data.category.name}</span>
                        </div>
                        <div class="mb-3 mt-4 col-lg-6 col-md-6 col-12 pe-4">
                            <h5>Start Date</h5>
                            <span> ${button_data.start_date}</span>
                        </div>

                        <div class=" mt-4 col-lg-6 col-md-6 col-12 pe-4">
                            <h5>End date</h5>
                            <span> ${button_data.end_date}</span>
                        </div>
                        <div class="mb-4 mt-4 col-lg-6 col-md-6 col-12 pe-4 checkbox-block">
                            <h5>Status</h5>
                            <span> ${eventStatus} </span>
                        </div>

                        <div class="mb-4 mt-4 col-lg-6 col-md-6 col-12 pe-4">
                            <h5>Ticket-Type</h5>
                            <span class="text-capitalize"> ${ticket_type} </span>
                        </div>
                        <div class="mb-4 mt-4 col-lg-6 col-md-6 col-12 pe-4">
                            <h5>Seat</h5>
                            <span class="text-capitalize"> ${seat_details} </span>
                        </div>
                        <div class="mb-4 mt-4 col-lg-6 col-md-6 col-12 pe-4">
                            <h5>Price</h5>
                            <span class="text-capitalize"> ${price} </span>
                        </div>
                        <div class="mb-4 mt-4 col-lg-6 col-md-6 col-12 pe-4">
                            <h5>Desctiption</h5>
                            <span class="text-capitalize"> ${button_data.description} </span>
                        </div>
                        <div class="mb-4 mt-4 col-lg-6 col-md-6 col-12 pe-4">
                            <h5>image</h5>
                            <img src="${image}/${button_data.image}" alt="user">
                        </div>

                        <div class="mb-3 mt-2 col-lg-12 col-md-12 col-12 pe-4">
                            
                        </div>
                    </div>
                `);
            $('#eventDetails').modal('show');
        });
    </script>
@endpush
