@extends('admin.layout.master')
@section('title')
    Home Manage Site
@endsection
@section('page-name')
    Home Manage Site
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
                <span class="active-path g-color">FAQ</span>
            </a>
        </div>
        <div class="view-prodact">
            <a data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="las la-plus"></i>
                <span>New FAQ</span>
            </a>
        </div>
    </div>

    <!-- Button trigger modal -->
    <div class="table-content">
        @php
            $i = 1;
        @endphp

        <div class="table-wrapper table-responsive">
            <table class="custom-table table text-white rounded mt-5 ">
                <thead style="color:#7b8191;">
                    <tr class="text-center">
                        <th scope="col">No</th>
                        <th scope="col" style="text-align: center!important;">Queston</th>
                        <th scope="col" style="text-align: center!important;">Ans</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody class="text-center" style="color:#7b8191">
                    @if ($allFaq->count() == 0)
                        <tr>
                            <td colspan="99" class="text-center">No data found</td>
                        </tr>
                    @endif
                    @foreach ($allFaq as $item)
                        <tr>
                            <td class="text-capitalize">{{$i++}}</td>
                            <td class="text-capitalize" style="text-align: center!important;">{{ $item->question }}</td>
                            <td class="text-capitalize" style="text-align: center!important;">{!! Str::words($item->ans,10) !!}</td>
                            <td>
                                <a href="{{ route('admin.faq.edit', $item->id) }}" class="btn btn-primary rounded">
                                    <i class="fas fa-edit"></i></a>
                                <a href="{{ route('admin.faq.destroy', $item->id) }}"class="btn btn-danger rounded"><i
                                    class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $allFaq->links() }}
        </div>
    </div>

    
     <!-- Modal -->
     <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="{{ route('admin.faq.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="modal-content">
                        <div class="modal-header ">
                            <h5 class="modal-title text--base">@lang('Add FAQ')</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-4k" style="padding: 0px 20px;">
                                <div class=" col-lg-12 col-md-12 col-12 form-group">
                                    <label for="title">@lang('Question')</label>
                                    <input type="text" class="form--control" placeholder="question" name="question"
                                        id="title" value="">
                                </div>

                                <div class="col-lg-12 col-md-12 col-12 form-group">
                                    <label for="editor">@lang('Ans')</label>
                                    <textarea id="editor" name="ans" rows="5" class="form--control" value=""></textarea>
                                </div>
                                <div class="text-end mb-3">
                                    <button type="submit" class="btn--base">Save</button>
                                    <button type="button" class="btn--base bg-danger" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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
