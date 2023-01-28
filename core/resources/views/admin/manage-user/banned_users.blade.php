@extends('admin.layout.master')
@section('title')
    Banned-Users
@endsection
@section('page-name')
    Banned-Users
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
                <span class="active-path g-color">Banned-Users</span>
            </a>
        </div>
        <div class="view-prodact">

        </div>
    </div>

    <!-- Button trigger modal -->
    <div class="table-content">
        <div class="table-wrapper table-responsive">
            <table class="custom-table table text-white rounded mt-5">
                <thead class="text-center" style="color:#7b8191">
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Image</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Email</th>
                        <th scope="col">Country</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody class="text-center" style="color:#7b8191">
                    @if ($banned_users->count() == 0)
                        <tr>
                            <td colspan="99" class="text-center">No data found</td>
                        </tr>
                    @endif
                    @foreach ($banned_users as $user)
                        <tr>
                            <td class="text-capitalize">{{ $user->full_name }}</td>
                            <td><img class="table-user-img img-fluid d-block me-auto"
                                    src="{{ getImage(imagePath()['profile']['user']['path'] . '/' . $user->photo) }}"
                                    alt="Image"></td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->country }}</td>
                            <td>
                                <form action="{{ route('admin.user.access.edit', $user->id) }}" method="POST">
                                    @csrf
                                    <div class="btn-container">
                                        <label class="switch btn-color-mode-switch">
                                            <input type="checkbox" name="access" id="color_mode"
                                                @if ($user->access == 1) checked @endif>
                                            <label for="color_mode" data-on="Banned" data-off="Active"
                                                class="btn-color-mode-switch-inner"></label>
                                        </label>
                                    </div>
                                </form>
                            </td>
                            <td>
                                <a href="{{ route('admin.view.book', $user->id) }}" class="btn btn-primary rounded">
                                    <i class="fas fa-eye" data-bs-toggle="modal" data-bs-target="#exampleModal"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $banned_users->links() }}
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
        div.btn-container {
            display: table-cell;
            vertical-align: middle;
            text-align: center;
        }

        div.btn-container i {
            display: inline-block;
            position: relative;
            top: -9px;
        }

        label {
            font-size: 13px;
            color: #424242;
            font-weight: 500;
        }

        .btn-color-mode-switch {
            display: inline-block;
            margin: 0px;
            position: relative;
        }

        .btn-color-mode-switch>label.btn-color-mode-switch-inner {
            margin: 0px;
            width: 170px;
            height: 30px;
            background: #E0E0E0;
            border-radius: 26px;
            overflow: hidden;
            position: relative;
            transition: all 0.3s ease;
            /*box-shadow: 0px 0px 8px 0px rgba(17, 17, 17, 0.34) inset;*/
            display: block;
        }

        .btn-color-mode-switch>label.btn-color-mode-switch-inner:before {
            content: attr(data-on);
            position: absolute;
            font-size: 12px;
            font-weight: 500;
            top: 7px;
            right: 20px;

        }

        .btn-color-mode-switch>label.btn-color-mode-switch-inner:after {
            content: attr(data-off);
            width: 85px;
            height: 25px;
            background: #fff;
            border-radius: 26px;
            position: absolute;
            left: 2px;
            top: 2px;
            text-align: center;
            transition: all 0.3s ease;
            box-shadow: 0px 0px 6px -2px #111;
            padding: 5px 0px;
        }

        .btn-color-mode-switch>.alert {
            display: none;
            background: #FF9800;
            border: none;
            color: #fff;
        }

        .btn-color-mode-switch input[type="checkbox"] {
            cursor: pointer;
            width: 50px;
            height: 25px;
            opacity: 0;
            position: absolute;
            top: 0;
            z-index: 1;
            margin: 0px;
        }

        .btn-color-mode-switch input[type="checkbox"]:checked+label.btn-color-mode-switch-inner {
            background: #3c3c3c;
            color: #fff;
        }

        .btn-color-mode-switch input[type="checkbox"]:checked+label.btn-color-mode-switch-inner:after {
            content: attr(data-on);
            left: 83px;
            background: rgb(231, 6, 6);

        }

        .btn-color-mode-switch input[type="checkbox"]:checked+label.btn-color-mode-switch-inner:before {
            content: attr(data-off);
            right: auto;
            left: 20px;

        }

        .btn-color-mode-switch input[type="checkbox"]:checked+label.btn-color-mode-switch-inner {
            /*background: #66BB6A; */
            /*color: #fff;*/
        }

        .btn-color-mode-switch input[type="checkbox"]:checked~.alert {
            display: block;
        }

        /*mode preview*/
        .dark-preview {
            background: #0d0d0d;
        }

        .dark-preview div.btn-container i.fa-sun-o {
            color: #777;
        }

        .dark-preview div.btn-container i.fa-moon-o {
            color: #fff;
            text-shadow: 0px 0px 11px #fff;
        }

        .white-preview {
            background: #fff;
        }

        .white-preview div.btn-container i.fa-sun-o {
            color: #ffa500;
            text-shadow: 0px 0px 16px #ffa500;
        }

        .white-preview div.btn-container i.fa-moon-o {
            color: #777;
        }

        p.by {}

        p.by a {
            text-decoration: none;
            color: #000;
        }

        .dark-preview p.by a {
            color: #777;
        }

        .white-preview p.by a {
            color: #000;
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
