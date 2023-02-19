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
            <a href="{{route('admin.index.events')}}">
                <span class="active-path g-color">My-Events</span>
            </a>
            <i class="las la-angle-right"></i>
            <a href="">
                <span class="active-path g-color">Events-sold</span>
            </a>
        </div>
        <div class="view-prodact">
            <a data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="las la-plus"></i>
                <span>Add Events</span>
            </a>

        </div>
    </div>


    <!-- Button trigger modal -->
    <div class="table-content">
        <div class=" card-1 my-3">
            <div class="table-wrapper table-responsive">
                <table class="custom-table table text-white rounded mt-5">
                    <thead class="text-center" style="color:#7b8191">
                        <tr>
                            <th scope="col">User Name</th>
                            <th scope="col">Image</th>
                            <th scope="col">Title</th>
                            <th scope="col">Category Name</th>
                            <th scope="col">Status</th>
                            <th scope="col">Sold</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center" style="color:#7b8191">
                        @if ($events->count() == 0)
                            <tr>
                                <td colspan="99" class="text-center">No data found</td>
                            </tr>
                        @endif
                        @foreach ($events as $event)
                            <tr>
                                <td>{{ ($event->admin->adminUser->first_name ?? ' ') .' '.($event->admin->adminUser->last_name ?? '') }}</td>
                                <td><img class="table-user-img img-fluid d-block me-auto"
                                        src="{{ asset('core\storage\app\public\admin-profile\\' . $event->admin->adminUser->profile_pic ?? '') }}"
                                        alt="User Image"></td>
                                <td>{{ $event->title ?? '' }}</td>
                                <td>{{ $event->category->name ?? '' }}</td>
                                <td>
                                    <form action="{{ route('admin.event.status.edit', $event->id) }}" method="POST">
                                        @csrf
                                        <label class="switch" id="switch">
                                            <input type="checkbox" name="status"
                                                @if ($event->status == 1) checked @endif id="switchInput">
                                            <span class="slider round"></span>
                                        </label>
                                    </form>
                                </td>
                                <td>
                                    <a href="{{ route('admin.sold.out.events', $event->id) }}" class="btn btn-primary rounded">
                                        <i class="fas fa-eye"></i></a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.event.destroy', $event->id) }}"class="btn btn-danger rounded"><i
                                            class="fas fa-trash"></i></a>
                                    <a href="{{ route('admin.event.view', $event->id) }}" class="btn btn-primary rounded">
                                        <i class="fas fa-edit"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $events->links() }}
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{route('admin.store.events')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="modal-header">
                            <h5 class="modal-title text--base">@lang('Add Events')</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-4k" style="padding: 20px;">
                                <div class=" col-lg-6 col-md-6 col-12 form-group">
                                    <label for="title" class="form-label text-white">Title</label>
                                    <input type="text" class="form-control" placeholder="Title" name="title"
                                        id="title" value="">
                                </div>
                                <div class=" col-lg-6 col-md-6 col-12 form-group">
                                    <label for="start_date" class="form-label text-white">Start Date</label>
                                    <input type="date" class="form-control" placeholder="Start Date" name="start_date"
                                        id="start_date" required>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12 form-group" >
                                    <label for="end_date" class="form-label text-white">End Date</label>
                                    <input type="date" class="form-control" placeholder="End Date" name="end_date"
                                        id="end_date" required>
                                </div>
                                <div class=" col-lg-6 col-md-6 col-12 ">
                                    <label for="categoty" class="form-label text-white">Category</label>
                                    <select class="form-select form-select-md mb-3 text-capitalize form-control"
                                        aria-label=".form-select-lg example" name="category">
                                        <option value=""> -- </option>
                                        @foreach ($categories as $category)
                                            <option @if ($category->id)  @endif value="{{ $category->id }}">
                                                {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class=" col-lg-6 col-md-6 col-12 form-group">
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
                                                        id="doller-input"
                                                        placeholder="Enter your {{ $item->name }} Price"
                                                        name="price[]">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="col-lg-6 col-md-6 col-12 form-group">
                                    <label for="">@lang('Image') </label>
                                    <input type="file" src="" class="form--control" name="image"
                                        accept="image/*" id="image">
                                </div>

                                <div class="mb-4 mt-4 col-lg-12 col-md-12 col-12 form-group">
                                    <label for="editor">@lang('Description')</label>
                                    <textarea id="editor" name="description" rows="5" class="form--control" value=""></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn--base me-2">Save</button>
                            <button type="button" class="btn--base bg-danger" data-bs-dismiss="modal">Close</button>
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
