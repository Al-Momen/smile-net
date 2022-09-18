@extends('admin.layout.master')

@section('content')
    <div class="table-area">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-wrapper table-responsive">
                    <table class="custom-table">
                        <thead>
                        <tr class="custom-table-row">
                            <th>Short Code</th>
                            <th>Description</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>@{{Name}}</td>
                                <td>Name</td>
                            </tr>
                            <tr>
                                <td>@{{Message}}</td>
                                <td>Message</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="user-detail-area mt-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="user-info-header two">
                    <h5 class="title">SMS Sent From</h5>
                </div>
                <div class="dashboard-form-area two mt-10">
                    <form class="dashboard-form" action="{{ route('admin.sms.templates.global') }}" method="POST">
                        @csrf
                        <div class="row justify-content-center mb-10-none">
                            <div class="col-lg-12 form-group">
                                <label>Global Template *</label>
                                <input type="text"  class="form--control"  placeholder="@lang('SMS API Configuration')" name="sms_api" value="{{ $general->sms_api }}" required/>
                            </div>
                            <div class="col-lg-12 form-group">
                                <button type="submit" class="btn btn--base w-100">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
