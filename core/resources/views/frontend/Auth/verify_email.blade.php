<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Verify Email</title>
</head>
<body>
    
    <h2> Welcome to our website Smile-net</h2>
    <p> Your OTP code <h1>{{$code}}</h1> </p>
    <div class="row">

        <div class="table-area">
            <div class="row">
                <div class="col-lg-12">
                    <div class="user-info-header two">
                        <h5 class="title">Global Email Template</h5>
                    </div>
                    <div class="table-wrapper table-responsive">
                        <table class="custom-table">
                            <thead>
                            <tr>
                                <th>Short Code</th>
                                <th>Description</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>@{{full name}}</td>
                                    <td>User Full Name</td>
                                </tr>
                                <tr>
                                    <td>@{{username}}</td>
                                    <td>Username</td>
                                </tr>
                                <tr>
                                    <td>@{{message}}</td>
                                    <td>Message</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-12">
            {{-- <div class="card mt-5">
                <div class="card-body">
                    <form action="{{ route('admin.email.template.global') }}" method="POST">
                        @csrf
                        <div class="form-row">

                            <div class="form-group col-md-12">
                                <label class="font-weight-bold">@lang('Email Sent From') <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg" placeholder="@lang('Email address')" name="email_from" value="{{ $general->email_from }}" required/>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="font-weight-bold">@lang('Email Body') <span class="text-danger">*</span></label>
                                <textarea name="email_template" rows="10" class="form-control form-control-lg nicEdit" placeholder="@lang('Your email template')">{{ $general->email_template }}</textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-block btn--primary mr-2">@lang('Update')</button>
                    </form>
                </div>
            </div><!-- card end --> --}}

            <div class="user-detail-area mt-30">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="user-info-header two">
                            <h5 class="title">Email Sent From</h5>
                        </div>
                        <div class="dashboard-form-area two mt-10">
                            <form class="dashboard-form" action="{{ route('admin.email.template.global.update') }}" method="POST">
                                @csrf
                                <div class="row justify-content-center mb-10-none">
                                    <div class="col-lg-12 form-group">
                                        <input type="text" class="form--control" placeholder="@lang('Email address')" name="email_from" value="{{ $general->email_from }}" required>
                                    </div>
                                    <div class="col-lg-12 form-group">
                                        <textarea class="form--control nicEdit" name="email_template" placeholder="@lang('Your email template')">{{ $general->email_template }}</textarea>
                                    </div>
                                    <div class="col-lg-12 form-group">
                                        <button type="submit" class="btn btn--base w-100" >Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>