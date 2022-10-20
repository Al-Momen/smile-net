@extends('admin.layout.master')
@section('title')
    Vote
@endsection
@section('page-name')
    Vote
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
            <a href="{{ route('admin.vote.index') }}">
                <span class="active-path g-color">Vote</span>
            </a>
            <i class="las la-angle-right"></i>
            <a href="#">
                <span class="active-path g-color">Edit Vote</span>
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
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('success') }}!</strong> <button type="button" class="btn-close"
                        data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <!-- Button trigger modal -->
            <div>
                <div>
                    <form action="{{ route('admin.vote.update', $adminVote->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="modal-content">
                                <div class="modal-header bg--primary">
                                    <h5 class="modal-title text-white">@lang('Update Vote Types')</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>@lang('Vote Types Name')</label>
                                        <input class="form-control form--control" type="text" name="vote_name"
                                            placeholder="@lang('Vote Types Name')" required value="{{ $adminVote->vote_name }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="image" class="form-label">@lang('voting Image')</label>
                                        <input type="file" src="" class="form-control px-3 pt-2" name="vote_image"
                                            accept="image/*" id="image"
                                            style="
                                        padding-top: 14px !important;
                                    ">
                                    </div>
                                    <div class="form-group">
                                        <label for="ticket" class="form-label">@lang('Ticket')</label>
                                        <select class="form-select form-select-md mb-3 text-capitalize"
                                            style="padding: 12px 10px;" aria-label=".form-select-lg example" name="ticket">
                                            <option value=""> -- </option>
                                            @foreach ($ticketType as $ticket)
                                                <option @if ($ticket->id == $adminVote->ticket_id) selected  @endif
                                                    value="{{ $ticket->id }}">
                                                    {{ $ticket->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="categoty" class="form-label">@lang('Vote')</label>
                                        <select class="form-select form-select-md mb-3 text-capitalize"
                                            style="padding: 12px 10px;" aria-label=".form-select-lg example"
                                            name="category">
                                            <option value=""> -- </option>
                                            @foreach ($categories as $category)
                                                <option @if ($category->id == $adminVote->category_id) selected  @endif
                                                    value="{{ $category->id }}">
                                                    {{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('Item Name One')</label>
                                        <input class="form-control form--control" type="text" name="name_one"
                                            placeholder="@lang('Item Name One')" required value="{{ $adminVote->name_one }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="image" class="form-label">@lang('Image')</label>
                                        <input type="file" src="" class="form-control px-3 pt-2" name="image_one"
                                            accept="image/*" id="image"
                                            style="
                                        padding-top: 14px !important;
                                    ">
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('Item Name Two')</label>
                                        <input class="form-control form--control" type="text" name="name_two"
                                            placeholder="@lang('Item Name Two')" required value="{{ $adminVote->name_two }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="image" class="form-label">@lang('Image Two')</label>
                                        <input type="file" src="" class="form-control px-3 pt-2" name="image_two"
                                            accept="image/*" id="image"
                                            style="
                                        padding-top: 14px !important;
                                    ">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><a
                                        href="{{ route('admin.vote.index') }}">Close</a></button>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
