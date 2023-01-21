@extends('admin.layout.master')
@section('title')
    Email Template
@endsection
@section('page-name')
    Email Template
@endsection

@php
    $roles = userRolePermissionArray();
@endphp
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="user-detail-area">
                <div class="row">
                    <div class="col-lg-12 mb-30">
                        <div class="user-info-header two">
                            <h5 class="title">Email Configuration</h5>
                            <div class="info-btn">
                                {{-- <a type="button" data-bs-target="#testMailModal" data-bs-toggle="modal"><span class="nane-btn">Send Test Mail</span> <i class="las la-paper-plane"></i></a> --}}
                                <a href="#0" class="btn btn--base" data-bs-toggle="modal"
                                    data-bs-target="#exampleModalTwo"> Send Test Mail <i class="las la-paper-plane"></i></a>
                            </div>
                        </div>
                        <div class="dashboard-form-area two mt-10">
                            <form class="dashboard-form" action="{{ route('admin.email.template.setting.update') }}"
                                method="POST">
                                @csrf
                                <div class="row justify-content-center mb-10-none">
                                    <div class="col-lg-12 form-group">
                                        <label>Email Send Method</label>
                                        <select name="email_method" class="form-control">
                                            <option value="smtp" @if ($general->mail_config->name == 'smtp') selected @endif>
                                                @lang('SMTP')</option>
                                        </select>
                                    </div>

                                    <div class="form-row mt-4  configForm" id="smtp">
                                        <div class="col-md-12">
                                            <h6 class="mb-2">@lang('SMTP Configuration')</h6>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <label class="font-weight-bold">@lang('Host') <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control"
                                                    placeholder="e.g. @lang('smtp.googlemail.com')" name="host"
                                                    value="{{ $general->mail_config->host ?? '' }}" />
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="font-weight-bold">@lang('Port') <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" placeholder="@lang('Available port')"
                                                    name="port" value="{{ $general->mail_config->port ?? '' }}" />
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="font-weight-bold">@lang('Encryption')</label>
                                                <select class="form-control" name="enc">
                                                    <option
                                                        value="ssl"{{ $general->mail_config->enc == 'ssl' ? 'Selected' : '' }}>
                                                        @lang('SSL')</option>
                                                    <option value="tls"
                                                        {{ $general->mail_config->enc == 'tls' ? 'Selected' : '' }}>
                                                        @lang('TLS')</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="font-weight-bold">@lang('Username') <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control"
                                                    placeholder="@lang('Normally your email') address" name="username"
                                                    value="{{ $general->mail_config->username ?? '' }}" />
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="font-weight-bold">@lang('Password') <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" placeholder="@lang('Normally your email password')"
                                                    name="password" value="{{ $general->mail_config->password ?? '' }}" />
                                            </div>
                                        </div>
                                    </div>

                                    {{-- <div class="form-row mt-4  configForm" id="sendgrid">
                                        <div class="col-md-12">
                                            <h6 class="mb-2">@lang('SendGrid API Configuration')</h6>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>@lang('App Key') <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" placeholder="@lang('SendGrid App key')" name="appkey" value="{{ $general->mail_config->appkey ?? '' }}"/>
                                        </div>
                                    </div> --}}
                                    {{-- <div class="form-row mt-4  configForm" id="mailjet">
                                        <div class="col-md-12">
                                            <h6 class="mb-2">@lang('Mailjet API Configuration')</h6>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label class="font-weight-bold">@lang('Api Public Key') <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" placeholder="@lang('Mailjet Api Public Key')" name="public_key" value="{{ $general->mail_config->public_key ?? '' }}"/>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="font-weight-bold">@lang('Api Secret Key') <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" placeholder="@lang('Mailjet Api Secret Key')" name="secret_key" value="{{ $general->mail_config->secret_key ?? '' }}"/>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="col-lg-12 form-group mt-10">
                                        <button type="submit" class="btn btn--base w-100">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>


    {{-- TEST MAIL MODAL --}}
    {{-- <div id="testMailModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Test Mail Setup')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.email.template.test.mail') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>@lang('Sent to') <span class="text-danger">*</span></label>
                                <input type="text" name="email" class="form-control" placeholder="@lang('Email Address')">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn--success">@lang('Send')</button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}

    <div class="modal fade" id="exampleModalTwo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Test Mail Setup')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                            class="las la-times"></i></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.email.template.test.mail') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id">
                        <div class="modal-body">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>@lang('Sent to') <span class="text-danger">*</span></label>
                                    <input type="text" name="email" class="form-control"
                                        placeholder="@lang('Email Address')">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer mt-20">
                            <a class="btn--base bg--danger" data-bs-dismiss="modal">Close</a>
                            <button type="submit" class="btn--base">Submit</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection


@push('script')
    <script>
        (function($) {
            "use strict";

            var method = '{{ $general->mail_config->name ?? '' }}';
            emailMethod(method);
            $('select[name=email_method]').on('change', function() {
                var method = $(this).val();
                emailMethod(method);
            });

            function emailMethod(method) {
                $('.configForm').addClass('d-none');
                if (method != 'php') {
                    $(`#${method}`).removeClass('d-none');
                }
            }

        })(jQuery);
    </script>
@endpush
