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
  
    <!-- Modal -->

    <form action="{{ route('admin.update.smile.tv', $smileTv->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
            <div class="modal-content">
                
                <div class="user-info-header two mb-4">
                    <h5 class="title text-white">@lang('Edit Edit TV Show')</h5>
                </div>
                <div class="modal-body">
                    <div class="row g-4k" style="padding: 0px 20px;">
                        <div class=" col-lg-6 col-md-6 col-12 form-group">
                            <label for="title">@lang('Title')</label>
                            <input type="text" class="form--control" placeholder="Title" name="title" id="title"
                                value="{{ $smileTv->title }}">
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 form-group">
                            <label for="name">@lang('Name')</label>
                            <input type="text" class="form--control" placeholder="Name" name="name" id="name"
                                value="{{ $smileTv->name }}">
                        </div>

                        <div class=" mt-4 col-lg-6 col-md-6 col-12 form-group">
                            <label for="categoty">@lang('Category')</label>
                            <select class="form--control text-capitalize" style="padding: 12px 10px;"
                                aria-label=".form-select-lg example" name="category">
                                <option value=""> -- </option>
                                @foreach ($categories as $category)
                                    <option @if ($category->id == $smileTv->category_id) selected @endif value="{{ $category->id }}">
                                        {{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- <div class=" mt-4 col-lg-6 col-md-6 col-12 form-group">
                            <label for="Ticket-Type">@lang('Ticket-Type')</label>
                            <select class="form-select form-select-md mb-3 text-capitalize" style="padding: 12px 10px;"
                                aria-label=".form-select-lg example" name="ticket_type">
                                <option value=""> -- </option>
                                @foreach ($ticketTypes as $ticketType)
                                    <option @if ($ticketType->id == $smileTv->ticket_type_id) selected  @endif value="{{ $ticketType->id }}">
                                        {{ $ticketType->name }}</option>
                                @endforeach
                            </select>
                        </div> --}}
                        
                        <div class=" mt-4 col-lg-6 col-md-6 col-12 form-group">
                            <label for="image">@lang('Image') </label>
                            <input type="file" src="" class="form--control" name="image"
                                accept="image/*" id="image">
                        </div>
                        <div class="mt-3 col-lg-6 col-md-6 col-12 form-group">
                            <label for="type">@lang('Date')</label>
                            <input type="datetime-local" class="form--control" placeholder="date" name="date"
                                id="type" value="{{ $smileTv->date }}">
                        </div>
                        <div class="mt-3 col-lg-6 col-md-6 col-12 form-group">
                            <label for="type">@lang('Smile-Tv')</label>
                            <input type="text" class="form--control" placeholder="Links" name="smile_tv_link"
                                id="type" value="{{ $smileTv->smile_tv_link }}">
                        </div>

                        <div class="mt-4 col-lg-12 col-md-12 col-12 form-group">
                            <label for="video">@lang('Video') </label>
                            <input type="file" src="" class="form--control" name="mp4"
                                accept="video/*,.mkv" id="video">
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn--base bg-primary">Update</button>
                            <button type="button" class="btn--base bg-danger" data-bs-dismiss="modal"><a
                                    href="{{ route('admin.smile.tv.index') }}">Back</a></button>
                        </div>
                    </div>
                </div>
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
