@extends('admin.layout.master')
@section('title')
    All-Users
@endsection
@section('page-name')
    All-Users
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
                <span class="active-path g-color">All-Users</span>
            </a>
        </div>
        <div class="view-prodact">

        </div>
    </div>

    <!-- Button trigger modal -->
    <div class="table-content">
        <div class="table-wrapper table-responsive">
            <table class="custom-table table text-white rounded mt-5 ">
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
                <tbody class="text-center" id ="allUser" style="color:#7b8191">
                    @if ($all_users->count() == 0)
                        <tr>
                            <td colspan="99" class="text-center">No data found</td>
                        </tr>
                    @endif
                    @foreach ($all_users as $user)
                        <tr>
                            <td class="text-capitalize">{{ $user->full_name }}</td>
                            <td><img class="table-user-img img-fluid d-block me-auto"
                                    src="{{ getImage(imagePath()['profile']['user']['path'] . '/' . $user->photo) }}"
                                    alt="Image"></td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->country }}</td>
                            <td>
                                @if ($user->access == 0)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Banned</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.view.user', $user->id) }}" class="btn btn-primary rounded">
                                    <i class="fas fa-eye" data-bs-toggle="modal" data-bs-target="#exampleModal"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $all_users->links() }}

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
    {{-- <script>
        $(document).ready(function() {
            $('.app-search').keyup(function(e) {
                var search = $('input[name=search]').val();
                $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                if (search != "") {
                    $.ajax({
                        url: "{{route('admin.search.users')}}",
                        method: "POST",
                        data: {
                            'search': search,
                        },
                        success: function(res) {
                            if (res.status) {
                                addDataToTable(res.data.data)
                            } else {
                                alert(res.message)
                            }
                        },
                        error: function(err) {
                            let error = err.responseJSON;
                            $.each(error.errors, function(index, value) {
                                console.log(value);
                                $('#commentShow').append(
                                    '<span class="text-danger">' +
                                    value +
                                    '</span>' + '</br>');
                            });
                        }
                    });
                }
            })

            function addDataToTable(data) {
                var table = $('tbody#allUser');
                console.log(data);
                table.html('');
                data.forEach((element, key) => {
                    var status = element.access == 0 ?
                                   '<span class="badge bg-success">Active</span>'
                                :
                                    '<span class="badge bg-danger">Banned</span>';
                    var image =`{{ getImage(imagePath()['profile']['user']['path'] . '/' . ':photo') }}`;
                    image = image.replace(':photo',element.photo);
                    var link = `{{ route('admin.view.user', ':id') }}`;
                    link = link.replace(':id',element.id);     
                    table.append(`
                        <tr>
                            <td class="text-capitalize">${element.full_name}</td>
                            <td>
                                <img class="table-user-img img-fluid d-block me-auto"
                                    src="${image}"
                                    alt="Image">
                            </td>
                            <td>${element.phone}</td>
                            <td>${element.email}</td>
                            <td>${element.country}</td>
                            <td>
                               ${status}
                            </td>
                            <td>
                                <a href="${link}" class="btn btn-primary rounded">
                                    <i class="fas fa-eye" data-bs-toggle="modal" data-bs-target="#exampleModal"></i></a>
                            </td>
                        </tr>
                    `)
                });
            }
        })
    </script> --}}



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
