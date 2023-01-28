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
        <h5 class="title" style="color:#7b8191">Dashboard</h5>
        <div href="" class="dashboard-path">
            <a href={{ route('admin.dashboard') }}>
                <span class="main-path" style="color:#7b8191">Dashboards</span>
            </a>
            <i class="las la-angle-right"></i>
            <a href="#">
                <span class="active-path g-color">Category</span>
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

        <!-- Button trigger modal -->
        <div class="table-wrapper table-responsive">
            <div>
                <table class="custom-table table text-white rounded mt-5">
                    <thead class="text-center" style="color:#7b8191">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Category Name</th>
                            <th scope="col">Category Description</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center" style="color:#7b8191">
                        @if ($categories->count() == 0)
                            <tr>
                                <td colspan="99" class="text-center">No data found</td>
                            </tr>
                        @endif
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->description }}</td>
                                <td>
                                    {{-- <a href="{{route('admin.category.destroy',$category->id)}}"class="btn btn-danger rounded"><i class="fas fa-trash"></i></a> --}}
                                    <a href="{{ route('admin.category.edit', $category->id) }}"
                                        class="btn btn-primary rounded"> <i class="fas fa-edit"
                                            data-bs-toggle="modal"></i></a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                {{ $categories->links() }}
            </div>
        </div>
    </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text--base">@lang('Add category')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <form action="{{ route('admin.category.store') }}" method="POST">
                    @csrf
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
                        <div class="form-group text-end">
                            <button type="submit" class="btn--base bg-primary">Save</button>
                            <button type="button" class="btn--base bg-danger" data-bs-dismiss="modal">Close</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
@endsection
