@extends('admin.layout.master')
@section('title')
    User Manual Getway
@endsection
@section('page-name')
    User Manual Getway
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
                <span class="active-path g-color">User Manual Getway</span>
            </a>
        </div>
        <div class="view-prodact">

            <span></span>

        </div>
    </div>
    <div class="table-content mt-5 " style="display:flex; ">
        <div class="row">
            <div class="card" style="width: 30rem;">
                <div class="card-header">
                    <h3 class="text-primary text-center">User Information</h3>
                </div>
                <div class="card-body">
                    <div class="block d-md-flex mb-sm-2 mb-md-0 justify-content-center align-items-center text-center">
                        <span class="text-center"><img
                                src="{{ asset('core\storage\app\public\profile\\' . $manualGetwayRequestView->user->photo) }}"
                                alt="user image" style="width: 150px; height: 150px; border-radius: 99px;"></span>
                    </div>
                    <hr>
                    <div class="block d-md-flex mb-sm-2 mb-md-0 justify-content-between align-items-center">
                        <span><strong>Name:</strong></span>
                        <span>{{ $manualGetwayRequestView->user->full_name }}</span>
                    </div>
                    <hr>
                    <div class="block d-md-flex mb-sm-2 mb-md-0 justify-content-between align-items-center">
                        <span><strong>User Name:</strong></span>
                        <span>{{ $manualGetwayRequestView->user->user_name }}</span>
                    </div>
                    <hr>
                    <div class="block d-md-flex mb-sm-2 mb-md-0 justify-content-between align-items-center">
                        <span><strong>Email:</strong></span>
                        <span>{{ $manualGetwayRequestView->user->email }}</span>
                    </div>
                    <hr>
                    <div class="block d-md-flex mb-sm-2 mb-md-0 justify-content-between align-items-center">
                        <span><strong>Phone:</strong></span>
                        <span>{{ $manualGetwayRequestView->user->phone }}</span>
                    </div>
                    <hr>
                    <div class="block d-md-flex mb-sm-2 mb-md-0 justify-content-between align-items-center">
                        <span><strong>Country:</strong></span>
                        <span>{{ $manualGetwayRequestView->user->country }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row ms-5">
            <div class="card" style="width: 30rem;">
                <div class="card-header">
                    <h3 class="text-primary text-center">Deposit User Data</h3>
                </div>
                <div class="card-body">
                    @php
                        $manual_getway_fields = json_decode($manualGetwayRequestView->gateway_parameters);
                    @endphp
                    @foreach ($manual_getway_fields as $item)
                        <div class="block d-md-flex mb-sm-2 mb-md-0 justify-content-between align-items-center">
                            <span><strong>{{ $item->field_lavel }}:</strong></span>
                            <span>{{ $item->value }}</span>
                        </div>
                        <hr>
                    @endforeach
                    <div class="block d-md-flex mb-sm-2 mb-md-0 justify-content-end align-items-center">
                        @if ($manualGetwayRequestView->status == 0)
                            <button class="btn btn-success me-2"><a
                                    href="{{ route('admin.manual.getway.request.approved', $manualGetwayRequestView->id) }}">Approved</a></button>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                Reject
                            </button>
                            {{-- <button class="btn btn-danger">
                                <a href="{{ route('admin.manual.getway.request.reject', $manualGetwayRequestView->id) }}">Reject</a>
                            </button> --}}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.manual.getway.request.reject', $manualGetwayRequestView->id) }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Reject</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Text:</label>
                            <textarea name="reject" id="" cols="10" rows="5"></textarea>
                          </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Reject</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </form>
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
            font-size: 20px;
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
    <script>
        $('.switch').click(function() {
            $(this).parents('form').submit();
        })
        $('#doller-input')
    </script>
    {{-- toastr --}}
    <script>
        @if (Session::has('success'))
            toastr.success("{{ session('success') }}")
        @endif
    </script>
@endsection
