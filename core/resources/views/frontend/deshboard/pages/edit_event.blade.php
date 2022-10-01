@extends('frontend.deshboard.master')
@section('content')
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
            <strong>{{ session('success') }}!</strong> <button type="button" class="btn-close" data-bs-dismiss="alert"
                aria-label="Close"></button>
        </div>
    @endif
    <form class="form-dashboard" action="{{ route('user.update.events', $event->id) }}"method="POST"
        enctype="multipart/form-data" id="addEventForm">
        @csrf
        <div class="errMsgContainer" style="padding: 20px;">

        </div>

        <div class="row g-4k" style="padding: 20px;">
            <h5 class="modal-title mb-4" id="addModalLabel">Events Update</h5>
            <div class=" col-lg-6 col-md-6 col-12 pe-4">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" placeholder="Title" name="title" id="title"
                    value="{{ $event->title }}">
            </div>
            <div class="mb-3 col-lg-6 col-md-6 col-12 pe-4">
                <label for="total_seat" class="form-label">Total Seat</label>
                <input type="number" class="form-control" placeholder="Total Sit" name="total_seat" id="total_seat"
                    value="{{ $event->total_seat }}" required>
            </div>
            <div class="mb-3 mt-4 col-lg-6 col-md-6 col-12 pe-4">
                <label for="start_date" class="form-label">Start Date</label>
                <input type="datetime-local" class="form-control" placeholder="Start Date" name="start_date" id="start_date"
                    value="{{ $event->start_date }}" required>
            </div>
            <div class="mb-3 mt-4 col-lg-6 col-md-6 col-12 pe-4">
                <label for="end_date" class="form-label">End Date</label>
                <input type="datetime-local" class="form-control" placeholder="End Date" name="end_date" id="end_date"
                    value="{{ $event->end_date }}" required>
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

            <div class="mb-3 mt-4 col-lg-6 col-md-6 col-12 pe-4">
                <label for="image" class="form-label">Image</label>
                <input type="file" src="" class="form-control px-3 pt-2" name="image" accept="image/*"
                    id="image">
            </div>
            <div class="mb-4 mt-4 col-lg-12 col-md-12 col-12 pe-4">
                <label for="editor" class="form-label">Description</label>
                <textarea id="editor" name="description" rows="5" class="form-control">{{ $event->description }}</textarea>

            </div>
            <div class="text-center" style="margin: auto;">
                <button type="submit" style="width: 440px;" class="btn btn-primary " id="btn_add">Update</button>

            </div>
        </div>

    </form>
@endsection

@push('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="alternate" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css"
        type="application/atom+xml" title="Atom">
@endpush
@push('css')
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
@endpush
