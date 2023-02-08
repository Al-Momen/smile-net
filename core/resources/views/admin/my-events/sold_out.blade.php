@extends('admin.layout.master')
@section('title')
    My-Events
@endsection
@section('page-name')
    My-Events
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
                <span class="active-path g-color">My-Events</span>
            </a>
        </div>
        <div class="view-prodact">


        </div>
    </div>


    <!-- Button trigger modal -->

    <div class="user-detail-area">
        <div class="row mb-30-none">
            <div class="col-lg-12 mb-30">
                <div class="user-info-header two">
                    <h5 class="title"> Event Sold out</h5>
                </div>
                @php
                    $no_data = true;
                @endphp
                @foreach ($sold_event_history as $events)
                    @if ($events->eventPlanTransaction->count() > 0)
                        @php
                            $no_data = false;
                        @endphp
                    @endif
                    @foreach ($events->eventPlanTransaction as $event)
                        @if ($event->status == 1)
                            <div class="dashboard-form-area two mt-10">
                                <div class="pending-deposit-content-area mt-20">
                                    <ul class="content-list">
                                        <li class="border-0">
                                            Title: {{ $event->eventPlans->event->title ?? ' ' }}
                                            <span>
                                                Paid Price: {{ $event->paid_price ?? ' ' }} {{ $currency->symbol ?? ' ' }}
                                            </span>
                                        </li>
                                        <li class="border-0">
                                            TRX No: {{ $event->transaction_id ?? ' ' }}
                                            <span>
                                                Charge: {{ $event->charge ?? ' ' }}
                                                {{ $currency->symbol ?? ' ' }}
                                            </span>
                                        </li>
                                        <li class="border-0">
                                            Gateway: {{ $event->payment_getway ?? ' ' }}
                                            <span>
                                                Discount: {{ $event->discount ?? ' ' }}
                                                {{ $currency->symbol ?? ' ' }}
                                            </span>
                                        </li>
                                        <li class="border-0">
                                            Ticket: {{ $events->ticketType->name ?? ' ' }}
                                            <span>
                                                Total Price: {{ $event->final_amo ?? ' ' }}
                                                {{ $currency->symbol ?? ' ' }}
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endforeach
                @if ($no_data == true)
                    <div class="col-12">
                        <div class="card mb-3 card-text">
                            <div class="card-text text-center">
                                <span class="text-capitalize text-center">{{ $empty_message }}</span>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            {{ $sold_event_history->links() }}
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

        /* ----------switch css---------- */
        .switch {
            position: relative;
            display: inline-block;
            width: 40px;
            height: 24px;
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
            left: -10px;
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
            transition: .8s;
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

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>

    <style>
        /* -----------------Modal css----------------- */
        .modal-header .btn-close {
            padding: 0.5rem 0.5rem;
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
@endsection

@section('scripts')
    <script>
        $('.switch').click(function() {
            $(this).parents('form').submit();
        })
    </script>
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
@endsection
