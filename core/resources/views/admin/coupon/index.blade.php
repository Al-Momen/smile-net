@extends('admin.layout.master')
@section('title')
    Coupon
@endsection
@section('page-name')
    Coupon
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
                <span class="active-path g-color">Coupon</span>
            </a>
        </div>
        <div class="view-prodact">
            <a data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="las la-plus"></i>
                <span>Add Coupon</span>
            </a>
        </div>
    </div>

    <!-- Button trigger modal -->
    <div class="table-content">
        <div class="shadow-lg card-1 my-3">
            <div class="table-wrapper table-responsive">
                @php
                    $i = 1;
                @endphp

                <table class="custom-table table text-white rounded mt-5 ">
                    <thead class="text-center" style="color:#7b8191">
                        <tr>
                            <th scope="col">SI</th>
                            <th scope="col">Coupon Name</th>
                            <th scope="col">Coupon Code</th>
                            <th scope="col">Discount Price</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center" style="color:#7b8191">
                        @if ($coupons->count() == 0)
                            <tr>
                                <td colspan="99" class="text-center">No data found</td>
                            </tr>
                        @endif
                        @foreach ($coupons as $coupon)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td class="text-capitalize">{{ $coupon->name }}</td>
                                <td>{{ $coupon->code }}</td>
                                <td>{{ $coupon->discount_price }}</td>
                                <td>
                                    <form action="{{ route('admin.coupon.status.edit', $coupon->id) }}" method="POST">
                                        @csrf
                                        <label class="switch" id="switch">
                                            <input type="checkbox" name="status"
                                                @if ($coupon->status == 1) checked @endif id="switchInput">
                                            <span class="slider round"></span>
                                        </label>
                                    </form>
                                </td>
                                <td>
                                    <a href="{{ route('admin.coupon.destroy', $coupon->id) }}"
                                        class="btn btn-danger rounded"> <i class="fas fa-trash" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $coupons->links() }}
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
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
                <form action="{{ route('admin.coupon.store') }}" method="POST">
                    @csrf
                    
                        <div class="modal-content" style="padding:0px">
                            <div class="modal-header ">
                                <h5 class="modal-title text-white">@lang('Add Coupon')</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>

                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>@lang('Coupon Name')</label>
                                    <input class="form-control form--control" type="text" name="name"
                                        placeholder="@lang('Coupon Name')" required value="{{ old('name') }}">
                                </div>
                                <div class="form-group">
                                    <label>@lang('Coupon Code')</label>
                                    <input class="form-control form--control" type="text" name="code"
                                        placeholder="@lang('Coupon Code')" required value="{{ old('code') }}">
                                </div>
                                <div class="form-group">
                                    <label>@lang('Coupon Price')</label>
                                    <input class="form-control form--control" type="number" name="price"
                                        placeholder="@lang('Coupon Price')" required value="{{ old('price') }}">
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn--base bg--primary">Save</button>
                                    <button type="button" class="btn--base bg-danger" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                   
                </form>
            </div>
        </div>
    </div>
@endsection
@section('css')
    <style>
        .table-user-img {
            height: 60px;
            width: 60px;
            border-radius: 70px;
        }

        .modal-header .btn-close {
            padding: 0.5rem 0.5rem;
            opacity: 1;
        }

        .modal-title {
            font-size: 17px;
        }

        .form-label {
            font-size: 15px;
        }

        /* Ck-editor css */
        .ck-blurred {
            height: 300px !important;
        }

        .ck-rounded-corners .ck.ck-editor__main>.ck-editor__editable,
        .ck.ck-editor__main>.ck-editor__editable.ck-rounded-corners {
            height: 300px;
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
    </style>
@endsection

@section('scripts')
    {{-- toastr --}}
    <script>
        @if (Session::has('success'))
            toastr.success("{{ session('success') }}")
        @endif
    </script>
    <script>
        $('.switch').click(function() {
            $(this).parents('form').submit();
        })
        $('#doller-input')
    </script>
@endsection
