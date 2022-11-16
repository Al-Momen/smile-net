@extends('admin.layout.master')
@section('title')
    All-Events
@endsection
@section('page-name')
    All-Events
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
                <span class="active-path g-color">All-Events</span>
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
            <!-- Button trigger modal -->
            <div>

                <div>
                    <table class="table text-white rounded mt-5">
                        <thead class="text-center">
                            <tr>
                                <th scope="col">User Name</th>
                                <th scope="col">Image</th>
                                <th scope="col">Title</th>
                                <th scope="col">Category Name</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @if ($events->count() == 0)
                                <tr>
                                    <td colspan="99">No data found</td>
                                </tr>
                            @endif
                            @foreach ($events as $event)
                                <tr>
                                    <td>{{ $event->user->full_name }}</td>
                                    <td><img class="table-user-img img-fluid d-block mx-auto"
                                            src="{{ asset('core\storage\app\public\profile\\' . $event->user->photo) }}"
                                            alt="Image"></td>
                                    <td>{{ $event->title }}</td>
                                    <td>{{ $event->category->name }}</td>
                                    <td>
                                        <form action="{{ route('admin.event.status.edit', $event->id) }}" method="POST">
                                            @csrf
                                            <label class="switch" id="switch">
                                                <input type="checkbox" name="status"
                                                    @if ($event->status == 1) checked @endif id="switchInput">
                                                <span class="slider round"></span>
                                            </label>
                                        </form>
                                    </td>
                                    <td>
                                        <a
                                            href="{{ route('admin.event.destroy', $event->id) }}"class="btn btn-danger rounded"><i
                                                class="fas fa-trash"></i></a>
                                        <a href="{{ route('admin.event.view', $event->id) }}"
                                            class="btn btn-primary rounded"> <i class="fas fa-edit"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$events->links()}}
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
@endsection
@section('css')
    <style>
        .table-user-img {
            height: 60px;
            width: 60px;
            border-radius: 70px;
        }

        /* ----------switch css---------- */
        .switch {
            position: relative;
            display: inline-block;
            width: 40px;
            height: 24px;
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
            left: -10px;
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
            transition: .8s;
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

        /* Rounded sliders */
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
    </script>
@endsection
