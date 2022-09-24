
@extends('frontend.deshboard.master')
@section('content')
<div class="table-content">


    <div class="header-title">
        <div class="row g-5 pt-3">

            <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                <div class="dashbord-user">
                    <div class="dashboard-content">
                        <div class="user-count">
                            <span class="text-uppercase">Books</span>
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
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Add Books 
            </button>
        </div>
        <div>
            <h3 class="text-white text-capitalize fw-bold pt-5 pb-3">Books</h3>
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
                            @foreach ($general_books as $book )
                        <tr>
                            <td >{{$book->title}}</td>
                            <td>{{$book->description}}</td>
                            <td>{{$book->price}}</td>
                            <td>{{$book->created_at->format('d-m-Y')}}</td>
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
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
 <!-- Modal -->
 <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content" style="
      background-color: white!important;">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Books Add</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
        </div>
        <div class="modal-body">
        <form class="form-dashboard" action="{{ route('user.store.books')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-4k" style="padding: 20px;">
                <div class="mb-3 col-lg-6 col-md-6 col-12 pe-4">
                    <label for="text1" class="form-label">Title</label>
                    <input type="text" class="form-control" id="text1" placeholder="Title" name="title" value={{ old('title')}}>
                </div>
                <div class="mb-3 col-lg-6 col-md-6 col-12 pe-4">
                    <label for="text2" class="form-label">Short
                        Description</label>
                    <input type="text" class="form-control" id="text2"
                        placeholder="Short Description" name="description" value={{ old('description')}}>
                </div>
                <div class="mb-3 col-lg-6 col-md-6 col-12 pe-4">
                    <label for="text2" class="form-label">Start Date</label>
                    <input type="date" class="form-control" id="text2"
                        placeholder="Start Date" name="start_date" value={{ old('start_date')}}>
                </div>
                <div class="mb-3 col-lg-6 col-md-6 col-12 pe-4">
                    <label for="text2" class="form-label">End Date</label>
                    <input type="date" class="form-control" id="text2"
                        placeholder="End Date" name="end_date" value={{ old('end_date')}}>
                </div>
                <div class="mb-3 col-lg-6 col-md-6 col-12 pe-4">
                    <label for="date1" class="form-label">Image</label>
                    <input type="file" class="form-control px-3 pt-2" name="image" value={{ old('image')}} accept="image/*">
                </div>
                <div class="col-lg-6 col-md-6 col-12 pe-4">
                    <label class="text-white">Country<span class="text-danger">*</span></label>
                    <select class="form-select form-select-md mb-3" style="padding: 12px 10px;"
                        aria-label=".form-select-lg example" name="country">
                        <option selected>Canada</option>
                        <option value="1">Japan</option>
                        <option value="2">Germany</option>
                        <option value="3">Switzerland</option>
                    </select>
                </div>
             </div>
             <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Add</button>
              </div>
        </form>
        <!-- Button trigger modal -->
        </div>
      </div>
    </div>
  </div>
@endsection
@push('css')
<style>
   .modal-header .btn-close 
{
    padding: 0.5rem 0.5rem;
    margin: 0.5rem 2.5rem -29.5rem auto;
    background-color: red !important;
}
.modal-title {
    font-size: 17px;
}
</style>

@endpush
