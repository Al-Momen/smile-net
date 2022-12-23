@extends('admin.layout.master')
@section('title')
    Category
@endsection
@section('page-name')
    Category
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
            <a href="{{ route('admin.ticket.type.index') }}">
                <span class="active-path g-color">Category</span>
            </a>
            <i class="las la-angle-right"></i>
            <a href="#">
                <span class="active-path g-color">Edit Category</span>
            </a>
        </div>
        <div class="view-prodact">

            <a data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="las la-plus"></i>
                <span>Add Category</span>
            </a>
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
                    <form action="{{ route('admin.ticket.type.update', $ticketTypes->id) }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="modal-content">
                                <div class="modal-header bg--primary">
                                    <h5 class="modal-title text-white">@lang('Edit Ticket Types')</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>@lang('Ticket Types Name')</label>
                                        <input class="form-control form--control" type="text" name="name"
                                            placeholder="@lang('Ticket Types Name')" required value="{{ $ticketTypes->name }}"
                                            readonly>
                                    </div>
                                    {{-- <div class="form-group">
                                        <label>@lang('Date')</label>
                                        <input class="form-control form--control" type="date" name="date"
                                            placeholder="@lang('Date')" required value="{{ $ticketTypes->name }}"
                                            >
                                    </div> --}}
                                    <div class="form-group">
                                        <div class="input-group mb-3 mt-3">
                                            <span class="input-group-text"
                                                style="
                                                    border-top-left-radius: 5px;border-bottom-left-radius:5px;">{{ $priceCurriency->symbol }}</span>
                                            <input type="number" class="form-control d-none" min="0"
                                                id="doller-input" placeholder="Price" name="priceCurriency_id"
                                                value="{{ $priceCurriency->id }}">
                                            <input type="number" class="form-control" min="0" id="doller-input"
                                                placeholder="Price" name="price" value={{ $ticketTypes->price }}>
                                        </div>
                                    </div>
                                    <div class="form-group"> 
                                        <label for="editor" class="form-label">@lang('Ticket Types Description')</label>
                                        <textarea id="editor" name="description" rows="5" class="form-control" required
                                            value="{{ old('description') }}" style="height: 140px;" placeholder="@lang('Ticket Types Description')">{{ $ticketTypes->description }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><a
                                    href="{{ route('admin.ticket.type.index') }}">Close</a></button>
                            <button type="submit" class="btn btn-primary">update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('css')
    <style>
        /* Ck-editor css */
        .ck-blurred {
            height: 300px !important;
        }

        .ck-rounded-corners .ck.ck-editor__main>.ck-editor__editable,
        .ck.ck-editor__main>.ck-editor__editable.ck-rounded-corners {
            height: 300px;
        }
    </style>
@endsection
@section('scripts')
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
