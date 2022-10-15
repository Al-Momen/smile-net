@extends('admin.layout.master')
@section('title')
    Currency
@endsection
@section('page-name')
    Currency
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
                <span class="active-path g-color">Currency</span>
            </a>
        </div>
        <div class="view-prodact">

            <a data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="las la-plus"></i>
                <span>Add Currency</span>
            </a>
        </div>
    </div>
    <div class="table-content">
        <div class="shadow-lg p-4 card-1 my-3">
            <!-- Button trigger modal -->
            <div>
                <div>
                    @php
                        $i = 1;
                    @endphp
                    <table class="table text-white rounded mt-5">
                        <thead class="text-center">
                            <tr>
                                <th scope="col">SI</th>
                                <th scope="col">Currency Name</th>
                                <th scope="col">Currency Code</th>
                                <th scope="col">Currency Symbol</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($priceCurrencies as $priceCurrency)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td class="text-capitalize">{{ $priceCurrency->name }}</td>
                                    <td>{{ $priceCurrency->code }}</td>
                                    <td>{{ $priceCurrency->symbol }}</td>
                                    <td>
                                        <a
                                            href="{{ route('admin.price.currency.destroy', $priceCurrency->id) }}"class="btn btn-danger rounded"><i
                                                class="fas fa-trash"></i></a>
                                        <a href="{{ route('admin.price.currency.edit', $priceCurrency->id) }}"
                                            class="btn btn-primary rounded"> <i class="fas fa-edit" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$priceCurrencies->links()}}
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    </div>
@endsection

@section('scripts')
 {{-- toastr --}}
 <script>
    @if (Session::has('success'))
        toastr.success("{{ session('success') }}")
    @endif
</script>
@endsection
