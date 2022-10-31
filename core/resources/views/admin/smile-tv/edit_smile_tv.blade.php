@extends('admin.layout.master')
@section('title')
    Smile-Tv
@endsection
@section('page-name')
    Smile-Tv
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
            <span class="active-path g-color">Edit Smile-Tv</span>
        </a>
    </div>
    <div class="view-prodact">
       
    </div>
</div>
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
            
        </div>
    </div>
    <!-- Modal -->

    <form action="{{ route('admin.update.smile.tv',$smileTv->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
            <div class="modal-content">
                <div class="modal-header bg--primary">
                    <h5 class="modal-title text-white">@lang('Edit TV Show')</h5>
                </div>
                <div class="modal-body">
                    <div class="row g-4k" style="padding: 20px;">
                        <div class=" col-lg-6 col-md-6 col-12 pe-4">
                            <label for="title" class="form-label">@lang('Title')</label>
                            <input type="text" class="form-control" placeholder="Title" name="title" id="title"
                                value="{{$smileTv->title}}">
                        </div>
                        <div class=" col-lg-6 col-md-6 col-12 pe-4">
                            <label for="name" class="form-label">@lang('Name')</label>
                            <input type="text" class="form-control" placeholder="Name" name="name" id="name"
                                value="{{$smileTv->name}}">
                        </div>

                        <div class=" mt-4 col-lg-6 col-md-6 col-12 pe-4">
                            <label for="categoty" class="form-label">@lang('Category')</label>
                            <select class="form-select form-select-md mb-3 text-capitalize" style="padding: 12px 10px;"
                                aria-label=".form-select-lg example" name="category">
                                <option value=""> -- </option>
                                @foreach ($categories as $category)
                                    <option @if ($category->id == $smileTv->category_id) selected  @endif value="{{ $category->id }}">
                                        {{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class=" mt-4 col-lg-6 col-md-6 col-12 pe-4">
                            <label for="Ticket-Type" class="form-label">@lang('Ticket-Type')</label>
                            <select class="form-select form-select-md mb-3 text-capitalize" style="padding: 12px 10px;"
                                aria-label=".form-select-lg example" name="ticket_type">
                                <option value=""> -- </option>
                                @foreach ($ticketTypes as $ticketType)
                                    <option @if ($ticketType->id == $smileTv->ticket_type_id) selected  @endif value="{{ $ticketType->id }}">
                                        {{ $ticketType->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-4 col-lg-6 col-md-6 col-12 pe-4">
                            <label for="type" class="form-label">@lang('Type')</label>
                            <input type="text" class="form-control" placeholder="Type" name="type" id="type"
                                value="{{$smileTv->type}}">
                        </div>
                        <div class=" mt-4 col-lg-6 col-md-6 col-12 pe-4">
                            <label for="image" class="form-label">@lang('Image') </label>
                            <input type="file" src="" class="form-control px-3 pt-2" name="image"
                                accept="image/*" id="image">
                        </div>
                        <div class="mt-4 col-lg-6 col-md-6 col-12 pe-4">
                            <label for="type" class="form-label">@lang('Date')</label>
                            <input type="datetime-local" class="form-control" placeholder="date" name="date" id="type"
                                value="{{$smileTv->date}}">
                        </div>
                        <div class="mt-4 col-lg-6 col-md-6 col-12 pe-4">
                            <label for="type" class="form-label">@lang('Smile-Tv')</label>
                            <input type="text" class="form-control" placeholder="Links" name="smile_tv_link" id="type"
                                value="{{$smileTv->smile_tv_link}}">
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><a href="{{route('admin.smile.tv.index')}}">Back</a></button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
    </form>

@endsection

@section('scripts')
   
    {{-- toastr --}}
    <script>
        @if (Session::has('success'))
            toastr.success("{{ session('success') }}")
        @endif
    </script>
@endsection


