@extends('admin.layout.master')
@section('title')
    Contact & Social Link
@endsection
@section('page-name')
    Contact & Social Link
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
                <span class="active-path g-color">Contact & Social Link</span>
            </a>
        </div>
        <div class="view-prodact">
        </div>
    </div>
    <div class="table-content">

        <!-- Button trigger modal -->
        <div>
            <div class="table-wrapper table-responsive">
                @php
                    $i = 1;
                @endphp
                <table class="custom-table table text-white rounded mt-5">
                    <thead class="text-center" style="color:#7b8191">
                        <tr>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Address</th>
                            <th scope="col">Facebook-link</th>
                            <th scope="col">Twitter-link</th>
                            <th scope="col">Instragram-link</th>
                            <th scope="col">Linkedin-link</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center" style="color:#7b8191">
                        @foreach ($socialLinks as $socialLink)
                            <tr>
                                <td>{{ $socialLink->email }}</td>
                                <td>{{ $socialLink->phone }}</td>
                                <td>{{ $socialLink->address }}</td>
                                <td>{{ $socialLink->fb_link }}</td>
                                <td>{{ $socialLink->twitter_link }}</td>
                                <td>{{ $socialLink->instragram_link }}</td>
                                <td>{{ $socialLink->linkedin_link }}</td>
                                <td>
                                    <a href="{{ route('admin.social.edit', $socialLink->id) }}"
                                        class="btn btn-primary rounded"> <i class="fas fa-edit" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $socialLinks->links() }}
            </div>
        </div>

    </div>
    <!-- Modal -->
    {{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
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
                <form action="{{ route('admin.price.currency.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="modal-content">

                            <div class="modal-header bg--primary">
                                <h5 class="modal-title text-white">@lang('Add Currency')</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>

                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>@lang('Currency Name')</label>
                                    <input class="form-control form--control" type="text" name="name"
                                        placeholder="@lang('Currency Name')" required value="{{ old('name') }}">
                                </div>
                                <div class="form-group">
                                    <label>@lang('Currency Code')</label>
                                    <input class="form-control form--control" type="number" name="code"
                                        placeholder="@lang('e.g: USD')" required value="{{ old('code') }}">
                                </div>
                                <div class="form-group">
                                    <label>@lang('Currency Symbol')</label>
                                    <input class="form-control form--control" type="text" name="symbol"
                                        placeholder="@lang('e.g: $')" required value="{{ old('symbol') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}
@endsection

@section('scripts')
    {{-- toastr --}}
    <script>
        @if (Session::has('success'))
            toastr.success("{{ session('success') }}")
        @endif
    </script>
@endsection
