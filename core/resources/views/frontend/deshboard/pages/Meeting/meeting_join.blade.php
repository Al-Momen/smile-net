@extends('frontend.deshboard.master')
@section('title')
    Meeting Join
@endsection

@section('content')
    <section class="pt-80 pb-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-sm">
                        <div class="card-header">
                            <h3 class="mb-0 text-white">Join a Meeting</h3>
                        </div>
                        <div class="card-body">
                            <div class="row gy-4">
                                <form action="{{route('user.join')}}" method="post" >
                                    @csrf
                                <div class="col-lg-12">
                                    <label class="text-white">Meeting Code</label>
                                    <div class="input-group">
                                        <button type="button" class="input-group-text bg-transparent"><i class="far fa-file-code"></i></button>
                                        <input type="text" name="meeting_code" class="form-control share-link" placeholder="Meeting code" value="">
                                    </div>
                                </div>
{{--                                <div class="col-lg-6">--}}
{{--                                    <label>Display Name</label>--}}
{{--                                    <div class="input-group">--}}
{{--                                        <button type="button" class="input-group-text bg-transparent"><i class="far fa-user"></i></button>--}}
{{--                                        <input type="text" class="form-control share-link" placeholder="Meeting URL" value="http://198.154.1.5:33000/dashboard.html">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="col-lg-12">
                                    <button type="submit" class=" btn btn-primary solid-btn w-100">Start Meeting</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
