@extends('frontend.deshboard.master')
@section('content')
    <div class="table-content">
        <div class="header-title">
            <div class="row g-5 pt-3">
                <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                    <div class="dashbord-user">
                        <div class="dashboard-content">
                            <div class="user-count">
                                <span class="text-uppercase">Events</span>
                            </div>
                            <div class="title pt-3">
                                <span>3 Active</span>
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
                                <span>4 Order</span>
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
                    {{-- @php
                    if($general_tickets->title == '')
                    {
                        echo '<span> No data found</span>';
                    }
                    else{
                    
                    }
                    
                @endphp --}}
                    <table class="table text-white rounded">
                        <thead>
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col">Start Date</th>
                                <th scope="col">End Date</th>
                                <th scope="col">Sold</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach ($general_events as $event)
                            <tr>
                                <td>{{ $event->title }}</td>
                                <td>{{ $event->start_date }}</td>
                                <td>{{ $event->end_date }}</td>
                                <td>{{ $event->title }}</td>
                                <td>
                                    <form>
                                        <label class="toggle">
                                            <div class="toggle__wrapper">
                                                <input type="checkbox">
                                                <div class="toggle__bg">
                                                    <div class="toggle__sphere">
                                                        <div class="toggle__sphere-bg">
                                                        </div>
                                                        <div class="toggle__sphere-overlay"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </label>
                                    </form>
                                </td>
                                <td class="">
                                    <a href="{{ route('user.destroy.events', $event->id) }}"><i
                                            class="fa-solid fa-trash-can btn btn-danger rounded">
                                        </i></a>
                                    <i class="fa-solid fa-edit btn btn-primary rounded" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">
                                    </i>
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
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="errMsgContainer" style="padding: 20px;">

                        </div>
                        <div class="row g-4k" style="padding: 20px;">
                            <div class="mb-3 col-lg-6 col-md-6 col-12 pe-4">
                                <label for="text1" class="form-label">Title</label>
                                <input type="text" class="form-control" placeholder="Title" name="title" id="title"
                                    value="">
                            </div>

                            <div class="mb-3 col-lg-6 col-md-6 col-12 pe-4">
                                <label for="text2" class="form-label">Start Date</label>
                                <input type="datetime-local" class="form-control" placeholder="Start Date"
                                    name="start_date" id="start_date" required>
                            </div>
                            <div class="mb-3 col-lg-6 col-md-6 col-12 pe-4">
                                <label for="text2" class="form-label">End Date</label>
                                <input type="datetime-local" class="form-control" placeholder="End Date" name="end_date"
                                    id="end_date" required>
                            </div>

                            <div class="mb-3 col-lg-6 col-md-6 col-12 pe-4">
                                <label for="date1" class="form-label">Image</label>
                                <input type="file" src="" class="form-control px-3 pt-2" name="image"
                                    accept="image/*" id="image">
                            </div>
                            <div class="mb-4 col-lg-12 col-md-12 col-12 pe-4">
                                <label for="text2" class="form-label">Description</label>
                                <textarea id="editor" name="description" rows="5" class="form-control" value=""></textarea>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
    <link rel="alternate" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css"
        type="application/atom+xml" title="Atom">
@endpush
@push('css')
    <style>
        .modal-header .btn-close {
            padding: 0.5rem 0.5rem;
            margin: 0.5rem 2.5rem -29.5rem auto;
            background-color: red !important;
        }

        .modal-title {
            font-size: 17px;
        }


        /* Ck-editor css */
        .ck-blurred {
            height: 200px !important;
        }

        .ck-rounded-corners .ck.ck-editor__main>.ck-editor__editable,
        .ck.ck-editor__main>.ck-editor__editable.ck-rounded-corners {
            height: 200px;
        }
    </style>
@endpush
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
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

        $("#btn_add").click(function(e) {
            var descriptionData = editor.getData();
            console.log(descriptionData);

        });
    </script>
    <script>
        // $(document).ready(function() {
        //     $("#btn_add").click(function(e) {
        //         $.ajaxSetup({
        //             headers: {
        //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //             }
        //         });
        //         e.preventDefault();
        //         function upload() {
        //             let fakepath = document.getElementById('image').value;
        //             let splits = fakepath.split('fakepath\\');
        //             let originalPath = splits[1];
        //             return originalPath;
        //         }
        //         let formData = {
        //             title: $('#title').val(),
        //             description: $('#description').val(),
        //             start_date: $('#start_date').val(),
        //             end_date: $('#end_date').val(),
        //             image: upload()
        //         };
        //         // console.log(formData);
        //         $.ajax({
        //             url: "{{ route('user.store.events') }}",
        //             method: "POST",
        //             data: formData,
        //             dataType: 'JSON',
        //             success: function(res) {
        //                 if (res.status == "success") {
        //                     $('#addModal').modal('hide');
        //                     $('#addEventForm')[0].reset();
        //                     $('.table').load(location.href + ' .table');
        //                     // toastr.info("done");
        //             }
        //         },
        //             error: function(err) {
        //                 let error = err.responseJSON;
        //                 $.each(error.errors, function(index, value) {
        //                     $('.errMsgContainer').append('<span class="text-danger">' +
        //                         value +
        //                         '</span>' + '</br>');
        //                 });
        //                 console.log(err);
        //             }
        //             //     error: function(qXHR, textStatus, errorThrown) {
        //             //     console.log(JSON.stringify(jqXHR));
        //             //     console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
        //             // }
        //         });
        //     });
        // })
    </script>
@endpush
