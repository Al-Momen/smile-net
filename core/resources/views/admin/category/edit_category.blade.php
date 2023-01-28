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
            <a href="{{ route('admin.category.index') }}">
                <span class="active-path g-color">Category</span>
            </a>
            <i class="las la-angle-right"></i>
            <a href="#">
                <span class="active-path g-color">Edit Category</span>
            </a>
        </div>
        <div class="view-prodact">

            
        </div>
    </div>

    <!-- Button trigger modal -->
    <div>
        <div>
            <form action="{{ route('admin.category.update', $category->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="modal-content">
                       
                        <div class="user-info-header two mb-4">
                            <h5 class="title text-white">@lang('Edit category')</h5>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>@lang('Category Name')</label>
                                <input class="form-control form--control" type="text" name="name"
                                    placeholder="@lang('Category Name')" required value="{{ $category->name }}">
                            </div>
                            <div class="form-group">
                                <label>@lang('Category Description')</label>
                                <textarea class="form-control form--control" type="text" name="description" rows="4" cols="50" required
                                    value="{{ old('category_description') }}" style="height: 140px;" placeholder="@lang('Category Description')">{{ $category->description }}</textarea>
                            </div>
                            <div class="form-group text-end">
                                <button type="submit" class="btn--base bg-primary">update</button>
                                <button type="button" class="btn--base bg-danger" data-bs-dismiss="modal"><a
                                    href="{{ route('admin.category.index') }}">Close</a></button>
                            </div>
                        </div>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
    
    <!-- Modal -->
    {{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.category.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="modal-content">

                            <div class="modal-header bg--primary">
                                <h5 class="modal-title text-white">@lang('Add category')</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>

                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>@lang('Category Name')</label>
                                    <input class="form-control form--control" type="text" name="name"
                                        placeholder="@lang('Category Name')" required value="{{ old('category_name') }}">
                                </div>
                                <div class="form-group">
                                    <label>@lang('Category Description')</label>
                                    <textarea class="form-control form--control" type="text" name="description" rows="4" cols="50" required
                                        value="{{ old('category_description') }}" style="height: 140px;" placeholder="@lang('Category Description')"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}
@endsection
@section('scripts')
@endsection
