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
                                <span> {{ $general_active_count }} Books</span>
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
                                <span>{{ $general_pending_count }} Books</span>
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
                                <span>{{ $general_sold_count }} Books</span>
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
                                <span> {{ $general_count }} Books</span>
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
                    Add Books
                </button>
            </div>
            <div>
                <h3 class="text-white text-capitalize fw-bold pt-5 pb-3">Books</h3>
                <div class="table-responsive">
                    <table class="table text-white rounded">
                        <thead>
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col">Category</th>
                                <th scope="col">Price</th>
                                <th scope="col">Status</th>
                                <th scope="col">Sold out</th>
                                <th scope="col">Read</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody class="">
                            @if ($general_count == 0)
                                <tr class="text-center">
                                    <td colspan="99">No data found</td>
                                </tr>
                            @endif
                            @foreach ($general_books as $book)
                                @if ($book->author_book_type == 'App\Models\GeneralUser')
                                    <tr>
                                        <td>{{ $book->title }}</td>
                                        <td>{{ optional($book->category)->name ?? 'N/A' }}</td>
                                        <td>
                                            {{ $book->price }} {{ $price->symbol }}
                                        </td>
                                        <td>
                                            @php
                                                if ($book->status == 1) {
                                                    echo '<span class="badge bg-success">Active</span>';
                                                } else {
                                                    echo '<span class="badge bg-danger">Pending</span>';
                                                }
                                            @endphp
                                        </td>
                                        <td class="">
                                            <a href="{{ route('user.sold.out.books', $book->id) }}">
                                                <i class="fa-solid fa-eye btn btn-primary rounded"></i>
                                            </a>
                                        </td>
                                        <td class="">
                                            <a target="_blank" class="btn btn-primary" href="{{ route('user.books.read', $book->id) }}">Read</a>
                                        </td>
                                        <td class="">
                                            <a href="{{ route('user.destroy.books', $book->id) }}"><i
                                                    class="fa-solid fa-trash-can btn btn-danger rounded">
                                                </i></a>
                                            <a href="{{ route('user.edit.books', $book->id) }}"> <i
                                                    class="fa-solid fa-edit btn btn-primary rounded" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal">
                                                </i></a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                    {{ $general_books->links() }}
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="addModalLabel" aria-hidden="true">
        <form class="form-dashboard" action="{{ route('user.store.books') }}" method="POST" enctype="multipart/form-data"
            id="addEventForm">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content"
                    style=" background-image: linear-gradient(to right top, #15243b, #1a2137, #1e1f33, #201c2e, #211a2a);!important;">
                    <div class="modal-header">
                        <h5 class="modal-title text-white" id="addModalLabel">Books Add</h5>
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
                            <div class="mb-3 mt-4 col-lg-6 col-md-6 col-12 pe-4" style="display:none">
                                <label for="tag" class="form-label text-white">price_id</label>
                                <input type="text" src="" class="form-control px-3 pt-2" name="price_id"
                                    id="tag" placeholder="Tag" value="{{ $price->id }}">
                            </div>
                            <div class=" col-lg-6 col-md-6 col-12 ">
                                <label for="doller-input" class="form-label text-white"> Price</label>
                                <div class="input-group ">
                                    <span class="input-group-text"
                                        style="
                                        border-top-left-radius: 5px;border-bottom-left-radius:5px;">{{ $price->symbol }}</span>
                                    <input type="number" class="form-control" min="0"
                                        id="doller-input" placeholder="Price" name="price">
                                </div>
                            </div>
                            <div class="mb-3 mt-4 col-lg-6 col-md-6 col-12 pe-4">
                                <label for="categoty" class="form-label text-white">Category</label>
                                <select class="form-select form-select-md mb-3 text-capitalize "
                                    style="padding: 12px 10px;" aria-label=".form-select-lg example" name="category">
                                    <option value=""> -- </option>
                                    @foreach ($categories as $category)
                                        <option @if ($category->id)  @endif value="{{ $category->id }}">
                                            {{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3  mt-4 col-lg-6 col-md-6 col-12 pe-4">
                                <label for="image" class="form-label text-white"> Cover Image</label>
                                <input type="file" src="" class="form-control " name="image"
                                    accept="image/*" id="image">
                            </div>

                            <div class="mb-3  mt-4 col-lg-6 col-md-6 col-12 pe-4">
                                <label for="file" class="form-label text-white">File <span class="text-danger"
                                        style="font-size:14px">(Pdf upload)</span></label>

                                <input type="file" src="" class="form-control " name="file"
                                    accept="application/pdf" id="file">
                            </div>
                            <div class="mb-3  mt-4 col-lg-6 col-md-6 col-12 pe-4">
                                <label for="tag" class="form-label text-white">Tag</label>
                                <input type="text" src="" class="form-control px-3 pt-2" name="tag"
                                    id="tag" placeholder="Tag">
                            </div>

                            <div class="mb-4 mt-4 col-lg-12 col-md-12 col-12 pe-4">
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

        .pagination .page-item .page-link {
            color: white;
        }
    </style>
@endpush
@push('js')
    {{-- toastr --}}
    <script>
        @if (Session::has('success'))
            toastr.success("{{ session('success') }}")
        @endif
    </script>

    {{-- status edit js --}}
    <script>
        $('.switch').click(function() {
            $(this).parents('form').submit();
        })
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
@endpush
