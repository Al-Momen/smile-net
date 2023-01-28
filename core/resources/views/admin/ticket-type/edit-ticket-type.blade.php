@extends('admin.layout.master')
@section('title')
    Subscription Plan
@endsection
@section('page-name')
    Subscription Plan
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
                <span class="active-path g-color">Subscription Plan</span>
            </a>
            <i class="las la-angle-right"></i>
            <a href="#">
                <span class="active-path g-color">Edit Subscription Plan</span>
            </a>
        </div>
        <div class="view-prodact">

            {{-- <a data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="las la-plus"></i>
                <span>Add Category</span>
            </a> --}}
        </div>
    </div>
    <div class="table-content">
        <div class="shadow-lg p-4 card-1 my-3">
            <!-- Button trigger modal -->
            <div>
                <div>
                    <form action="{{ route('admin.ticket.type.update', $ticketTypes->id) }}" method="POST">
                        @csrf
                        <div class="user-info-header two mb-4">
                            <h5 class="title text-white">@lang('Edit Currency')</h5>
                        </div>

                        <div class="form-group">
                            <label>@lang('Subscription Plan Name')</label>
                            <input class="form-control form--control" type="text" name="name"
                                placeholder="@lang('Subscription Plan Name')" required value="{{ $ticketTypes->name }}" readonly>
                        </div>
                        <div class="form-group">
                            <label>@lang('Subscription Price')</label>
                            <div class="input-group">
                                <span class="input-group-text"
                                    style="
                                        border-top-left-radius: 5px;border-bottom-left-radius:5px;">{{ $priceCurriency->symbol }}</span>
                                <input type="number" class="form--control d-none" min="0" id="doller-input"
                                    placeholder="Price" name="priceCurriency_id" value="{{ $priceCurriency->id }}">
                                <input type="number" class="form--control" min="0" id="doller-input"
                                    placeholder="Price" name="price" value={{ $ticketTypes->price }}>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>@lang('Subscription Days')</label>
                            <div class="input-group">
                                <input type="number" class="form--control" min="0" id="doller-input"
                                    placeholder="Enter your days" name="days" value={{ $ticketTypes->days }}>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="editor">@lang('Subscription Description')</label>
                            <textarea id="editor" name="description" rows="5" class="form--control" required
                                value="{{ old('description') }}" style="height: 140px;" placeholder="@lang('Ticket Types Description')">{{ $ticketTypes->description }}</textarea>
                        </div>
                        <div class="form-group text-end">
                            <button type="submit" class="btn--base bg-primary">update</button>
                            <button type="button" class="btn--base bg-danger" data-bs-dismiss="modal"><a
                                    href="{{ route('admin.ticket.type.index') }}">Close</a></button>

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
