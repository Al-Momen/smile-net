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
                <span class="active-path g-color">All-Books</span>
            </a>
        </div>
        <div class="view-prodact">

        </div>
    </div>

    <!-- Button trigger modal -->
    <div class="table-content">

        <div class="table-wrapper table-responsive">
            <table class="custom-table table text-white rounded mt-5">
                <thead class="text-center" style="color:#7b8191">
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Title</th>
                        <th scope="col">Image</th>
                        <th scope="col">Category Name</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody class="text-center" style="color:#7b8191">
                    @if ($general_books->count() == 0)
                        <tr>
                            <td colspan="99" class="text-center">No data found</td>
                        </tr>
                    @endif
                    @foreach ($general_books as $book)
                        @if ($book->author_book_type == 'App\Models\User')
                            <tr>
                                <td>{{ $book->admin->adminUser->first_name ?? ('' . ' ' . $book->admin->adminUser->last_name ?? '') }}
                                    {{ $book->admin->adminUser->last_name ?? '' }}</td>
                                <td>{{ $book->title ?? '' }}</td>
                                <td><img class="table-user-img img-fluid d-block me-auto"
                                        src="{{ asset('core\storage\app\public\books\\' . $book->image ?? '') }}"
                                        alt="Image"></td>
                                <td>{{ $book->category->name }}</td>
                                <td>
                                    <form action="{{ route('admin.book.status.edit', $book->id) }}" method="POST">
                                        @csrf
                                        <label class="switch" id="switch">
                                            <input type="checkbox" name="status"
                                                @if ($book->status == 1) checked @endif id="switchInput">
                                            <span class="slider round"></span>
                                        </label>
                                    </form>
                                </td>
                                <td>
                                    <a href="{{ route('admin.view.book', $book->id) }}" class="btn btn-primary rounded">
                                        <i class="fas fa-eye" data-bs-toggle="modal" data-bs-target="#exampleModal"></i></a>
                                </td>
                            </tr>
                        @endif
                        @if ($book->author_book_type == 'App\Models\GeneralUser')
                            <tr>
                                <td>{{ $book->user->full_name ?? '' }}</td>
                                <td>{{ $book->title ?? '' }}</td>
                                <td><img class="table-user-img img-fluid d-block me-auto"
                                        src="{{ asset('core\storage\app\public\books\\' . $book->image ?? '') }}"
                                        alt="Image"></td>
                                <td>{{ $book->category->name ?? '' }}</td>
                                <td>
                                    <form action="{{ route('admin.book.status.edit', $book->id) }}" method="POST">
                                        @csrf
                                        <label class="switch" id="switch">
                                            <input type="checkbox" name="status"
                                                @if ($book->status == 1) checked @endif id="switchInput">
                                            <span class="slider round"></span>
                                        </label>
                                    </form>
                                </td>
                                <td>
                                    <a href="{{ route('admin.view.book', $book->id) }}" class="btn btn-primary rounded">
                                        <i class="fas fa-eye" data-bs-toggle="modal" data-bs-target="#exampleModal"></i></a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            {{ $general_books->links() }}
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
