@extends('admin.layout.master')
@section('title')
    Manual-Getway
@endsection
@section('page-name')
    Manual-Getway
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
            <span class="active-path g-color">Manual-Getway</span>


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
            <!-- Button trigger modal -->
            <div>
                <div>
                    <form action="{{ route('admin.manual.paymentgetway.store') }}" class="gateway-form" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="modal-content">
                                <div class="modal-header bg--primary ">
                                    <h5 class="modal-title text-white">@lang('Manual-Getway')</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label>@lang('Gatway-name')<span style="color:red">*</span></label>
                                                <input class="form-control form--control" type="text" name="gatway_name"
                                                    placeholder="@lang('Type your Gatway name')" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label>@lang('Currency Code') <span style="color:red">*</span></label>
                                                <select class="custom-select form-control form--control" name="currency_code" id="currency_code">
                                                    @foreach ($currency as $item)
                                                    <option @if ($item->id)  @endif
                                                        value="{{ $item->id }}">
                                                        {{ $item->code }}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label>@lang('Getway Image') <span style="color:red">*</span></label>
                                                <input class="form-control form--control" type="file" name="image"
                                                    placeholder="@lang('Type your currency code')" accept="image/*" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6 col-lg-6">
                                            <div class="modal-header bg--primary">
                                                <h5 class="modal-title text-white">@lang('Range')</h5>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6 col-lg-6">
                                            <div class="modal-header bg--primary">
                                                <h5 class="modal-title text-white">@lang('Charge')</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6 col-lg-6">
                                            <div class="form-group mt-4">
                                                <label>@lang('Minimum Amount') <span style="color:red">*</span></label>
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text set_currency" id="basic-addon1">@</span>
                                                    <input class="form-control form--control" type="number"
                                                        name="minium_amount" placeholder="@lang('Minimum amount')" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6 col-lg-6">
                                            <div class="form-group mt-4">
                                                <label>@lang('Fixed Charge') <span style="color:red">*</span></label>
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text set_currency" id="basic-addon1">@</span>
                                                    <input class="form-control form--control" type="number"
                                                        name="fixed_charge" placeholder="@lang('0')" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6 col-lg-6">
                                            <div class="form-group mt-4">
                                                <label>@lang('Maximum Amount') <span style="color:red">*</span></label>
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text set_currency" id="basic-addon1">@</span>
                                                    <input class="form-control form--control" type="number"
                                                        name="maximum_amount" placeholder="@lang('Maximum amount')">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6 col-lg-6">
                                            <div class="form-group mt-4">
                                                <label>@lang('Percent Charge') <span style="color:red">*</span></label>
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">%</span>
                                                    <input class="form-control form--control" type="number"
                                                        name="percent_charge" placeholder="@lang('0')">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-lg-12 col-md-12">
                                            <div class="mb-4 mt-4 col-lg-12 col-md-12 col-12 pe-4">
                                                <label for="editor" class="form-label">@lang('Description')</label>
                                                <textarea id="editor" name="description" rows="5" class="form-control" value=""></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 col-md-12 col-lg-12">
                                            <div class="modal-header bg--primary">
                                                <h5 class="modal-title text-white">@lang('User Data')</h5>
                                                <button type="button" class="btn btn-success rounded"
                                                    id="fieldAddNew">Add New</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="results"></div>
                                    <div class="row align-items-center" id="fieldAppend">
                                        
                                        <div class="col-12 col-md-6 col-lg-3">
                                            <div class="form-group mt-4">
                                                <input class="form-control form--control" type="text"
                                                    name="field_name[]" placeholder="@lang('Field Name')" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-3">
                                            <div class="form-group mt-4">
                                                <select class="custom-select form-control form--control"
                                                    id="inputGroupSelect01" name="field_type[]">
                                                    <option value="input" selected>input Text</option>
                                                    <option value="number">Number</option>
                                                    <option value="file">File</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-3">
                                            <div class="form-group mt-4">
                                                <select class="custom-select form-control form--control"
                                                    id="inputGroupSelect01" name="field_validation[]">
                                                    <option value="required"selected>Required</option>
                                                    <option value="optional">Optional</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-3">
                                            <div class="form-group mt-4">
                                                <button disabled type="button"
                                                    class="btn btn-danger field-close rounded w-100">X</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger"> <a
                        href="{{ route('admin.manual.paymentgetway.view') }}">Back</a></button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
        </form>
    </div>

@endsection
@section('css')
    <style>
        /* Ck-editor css */
        .ck-blurred {
            height: 300px !important;
        }

        .ck-rounded-corners .ck.ck-editor__main>.ck-editor__editable,
        .ck.ck-editor__main>.ck-editor__editable.ck-rounded-corners {
            height: 300px;
        }
    </style>
@endsection
@section('scripts')
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
    <script>
        $('.gateway-form').on('click', '#fieldAddNew', function() {
            $('#fieldAddNew').closest('.gateway-form').find('#fieldAppend').last().clone().show().appendTo(
                '.results');
            $(".results").find("button.field-close").last().attr("disabled", false);
        });

        $(document).on('click', '#currency_code', function(e) {
            $(".set_currency").text($(this).text());
        });



        $(document).on('click', '.field-close', function(e) {
            e.preventDefault();
            $(this).parent().parent().parent().remove();
        });
    </script>
@endsection
