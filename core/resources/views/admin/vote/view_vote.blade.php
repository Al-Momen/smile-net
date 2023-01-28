@extends('admin.layout.master')
@section('title')
    User Vote
@endsection
@section('page-name')
    User Vote
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
                <span class="active-path g-color">View Vote</span>
            </a>
        </div>
        <div class="view-prodact">

            <span></span>

        </div>
    </div>
    <div class="table-content mt-5 ">
        <div class="row justify-content-center mb-30-none">
            <div class="col-xl-4 col-lg-6 col-md-6 mb-30">
                <div class="dashboard-form-area">
                    <div>
                        <h3 class="text--base text-center">User Information</h3>
                    </div>
                    <div class="card-body">
                        <div class="block d-md-flex mb-sm-2 mb-md-0 justify-content-center align-items-center text-center">
                            <span class="text-center">
                                <img src="{{ getImage(imagePath()['profile']['user']['path'].'/'. $votes->user->photo, imagePath()['profile']['user']['size'])}}"
                                    alt="user image" style="width: 150px; height: 150px; border-radius: 99px;">
                                </span>
                                    {{-- {{ getImage(imagePath()['profile']['user']['path'].'/'.$manualBookRequestView->user->photo,imagePath()['profile']['user']['size'])}} --}}
                        </div>
                        <hr>
                        <div class="block d-md-flex mb-sm-2 mb-md-0 justify-content-between align-items-center">
                            <span><strong>Name:</strong></span>
                            <span>{{ $votes->user->full_name ?? ' ' }}</span>
                        </div>
                        <hr>
                       
                        <div class="block d-md-flex mb-sm-2 mb-md-0 justify-content-between align-items-center">
                            <span><strong>Email:</strong></span>
                            <span>{{ $votes->user->email ?? ' ' }}</span>
                        </div>
                        <hr>
                        <div class="block d-md-flex mb-sm-2 mb-md-0 justify-content-between align-items-center">
                            <span><strong>Phone:</strong></span>
                            <span>{{ $votes->user->phone ?? ' ' }}</span>
                        </div>
                        <hr>
                        <div class="block d-md-flex mb-sm-2 mb-md-0 justify-content-between align-items-center">
                            <span><strong>Country:</strong></span>
                            <span class="text-capitalize">{{ $votes->user->country ?? ' ' }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 mb-30">
                <div class="dashboard-form-area">
                    <div>
                        <h3 class="text--base text-center">Votes Data</h3>
                    </div>
                    <div class="card-body">
                        <div class="">
                            <div class="text-center">
                                <img class=" img-fluid" src="{{ asset('core\storage\app\public\votes\\' . $votes->adminVoteImage->image ?? ' ') }}" alt="user-image" style="height:265px;">
                            </div>
                        </div>
                        <hr>
                        <div class="block d-md-flex mb-sm-2 mb-md-0 justify-content-between align-items-center">
                            <span><strong>Name:</strong></span>
                            <span>{{ $votes->adminVoteImage->name ?? ' ' }}</span>
                        </div>
                        <hr>
                        <div class="block d-md-flex mb-sm-2 mb-md-0 justify-content-between align-items-center">
                            <span><strong>Voted:</strong></span>
                            <span class="badge badge--success">{{$votes->voted ?? ' '}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    
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
