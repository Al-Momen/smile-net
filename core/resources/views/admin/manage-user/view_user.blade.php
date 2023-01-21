@extends('admin.layout.master')
@section('title')
    User-details
@endsection
@section('page-name')
    View-user
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
                <span class="active-path g-color">View-user</span>
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
            @if (session('danger'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ session('danger') }}!</strong> <button type="button" class="btn-close"
                        data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
    </div>
    <!-- Modal -->

    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                    Start ES Section
                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <div class="details-card">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-12">
                <div>
                    <div>
                        <img class=" img-fluid d-block mx-auto mt-4"
                            src="{{ getImage(imagePath()['profile']['user']['path'] .'/'. $view_user->photo) ?? null }}" alt="Image">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <div>
                    <h3 style="color:#7b8191">{{ $view_user->user_name }}</h3>
                    <div class="d-flex category">
                        <div class="me-5">
                            <p>First-Name: {{ $view_user->full_name }}</p>
                        </div>
                        <div class="me-5">
                            <p>Email: {{ $view_user->email }}</p>
                        </div>
                    </div>
                    <div class="d-flex category">
                        <div class="me-5">
                            <p>Phone: {{ $view_user->phone ?? null }}</p>
                        </div>
                        <div class="me-5">
                            <p>Country: {{ $view_user->country  ?? null}}</p>
                        </div>
                    </div>
                    <div class="d-flex category">
                        <div class="me-5">
                            <p>Facebook: {{ $view_user->facebook ?? null }}</p>
                        </div>
                    </div>
                    <div class="d-flex category">
                        <div class="me-5">
                            <p>Instagram: {{ $view_user->instagram ??null }}</p>
                        </div>
                    </div>
                    <div class="d-flex category">
                        <div class="me-5">
                            <p>Twitter: {{ $view_user->twitter ??null }}</p>
                        </div>
                    </div>
                    <div class="d-flex category">
                        <div class="me-5">
                            <p>Account: @if ($view_user->access == 0)
                                    <span class="badge bg-success">Active</span>
                                @else{
                                    <span class="badge bg-danger">Banned</span>
                                }
                            @endif</p>
                        </div>
                    </div>
                </div>
            </div>
           

            {{-- <div> 
                <a href="{{route('admin.all.users')}}" type="button" class="btn btn-info" style="float: right;">Back</a>
            </div> --}}
            
        </div>
    </div>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                    End ES Section
                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

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

        .details-card {
            background-color: #fff;
            margin: 40px;
            padding: 30px;
            border-radius: 8px;
        }

        .details-card .right-img {
            width: 40rem;
        }

        .details-card .category p {
            font-weight: 600;
            padding: 15px 0;
        }

        .details-card .price {
            padding-bottom: 15px;
            font-size: 30px;
            color: #198754;
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
