@extends('frontend.deshboard.master')
@section('content')
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
        <form class="form-dashboard" action="{{ route('user.store.books')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-4k">
                <div class="mb-3 col-lg-4 col-md-4 col-12 pe-4">
                    <label for="text1" class="form-label text-white">Title</label>
                    <input type="text" class="form-control" id="text1" placeholder="Title" name="title" value="{{ old('title')}}" >
                </div>
                <div class="mb-3 col-lg-4 col-md-4 col-12 pe-4">
                    <label for="text2" class="form-label text-white">Short
                        Description</label>
                    <input type="text" class="form-control" id="text2"
                        placeholder="Short Description" name="description" value="{{ old('description')}}">
                </div>
                <div class="mb-3 col-lg-4 col-md-4 col-12 pe-4">
                    <label for="date1" class="form-label text-white">Date</label>
                    <input type="date" class="form-control"name="date" value="{{ old('date') }}">
                </div>
                <div class="mb-3 col-lg-4 col-md-4 col-12 pe-4">
                    <label for="" class="form-label text-white">Image</label>
                    <input type="file" class="form-control px-3 pt-2"  name="image" accept="image/*" value="{{ old('image') }}">
                </div>
                <div class="mb-3 col-lg-4 col-md-4 col-12 pe-4">
                    <label for="" class="form-label text-white">Price</label>
                    <input type="number" class="form-control px-3 pt-2" placeholder="Price" name="price" value="{{ old('price')}}">
                </div>
                <div class="mb-3 col-lg-4 col-md-4 col-12 pe-4">
                    <label for="" class="form-label text-white">Category</label>
                    <input type="text" class="form-control px-3 pt-2" placeholder="category" name="category" value="{{ old('category')}}">
                </div>
                <div class="my-3 col-lg-6 col-md-6 col-12">
                    <button class="btn btn-primary rounded btn w-25">Add</button>
                </div>
            </div>
        </form>

        <div>
            <h3 class="text-white text-capitalize fw-bold pt-5 pb-3">Book</h3>

            <div>
                <table class="table text-white rounded">
                    <thead>
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Price</th>
                            <th scope="col">Date</th>
                            <th scope="col">Category</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($general_books as $book )
                        <tr>
                            <td >{{$book->title}}</td>
                            <td>{{$book->description}}</td>
                            <td>{{$book->price}}</td>
                            <td>{{$book->date}}</td>
                            <td>{{$book->category}}</td>
                            <td class="">
                                <a href="{{ route('user.destroy.books', $book->id)}}"><i class="fa-solid fa-trash-can btn btn-danger rounded">
                                </i></a>
                                <i class="fa-solid fa-edit btn btn-primary rounded"
                                    data-bs-toggle="modal" data-bs-target="#exampleModal">
                                </i>
                            </td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection