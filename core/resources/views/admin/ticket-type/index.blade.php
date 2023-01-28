@extends('admin.layout.master')
@section('title')
    Subscription Plan
@endsection
@section('page-name')
    Subscription Plan
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
                <span class="active-path g-color">Subscription Plan</span>
            </a>
        </div>
        <div class="view-prodact">
            {{-- <a data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="las la-plus"></i>
                <span>Add Ticket Type</span>
            </a> --}}
        </div>
    </div>
    <div class="table-content">
        <!-- Button trigger modal -->
        <div class="table-wrapper">
            <div class="table-responsive">
                @php
                    $i = 1;
                @endphp
                <table class="custom-table table text-white rounded mt-5 ">
                    <thead class="text-center" style="color:#7b8191">
                        <tr>
                            <th scope="col">SI</th>
                            <th scope="col">Ticket Type Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Days</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center" style="color:#7b8191">
                        @if ($ticketTypes->count() == 0)
                            <tr>
                                <td colspan="99">No data found</td>
                            </tr>
                        @endif
                        @foreach ($ticketTypes as $ticketType)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td class="text-capitalize">{{ $ticketType->name }}</td>
                                <td class="text-capitalize">{{ $ticketType->price }}
                                    {{ $ticketType->priceCurrency->symbol }}</td>
                                <td class="text-capitalize">{{ $ticketType->days ?? '' }} Days</td>
                                <td>
                                    {{-- <a 
                                            href="{{ route('admin.ticket.type.destroy', $ticketType->id) }}"class="btn btn-danger rounded"><i
                                                class="fas fa-trash"></i></a> --}}
                                    <a href="{{ route('admin.ticket.type.edit', $ticketType->id) }}"
                                        class="btn btn-primary rounded"> <i class="fas fa-edit"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $ticketTypes->links() }}
            </div>
        </div>
    </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.ticket.type.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="modal-content">
                            <div class="modal-header bg--primary">
                                <h5 class="modal-title text-white">@lang('Add Ticket Type')</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>

                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>@lang('Ticket Type Name')</label>
                                    <input class="form-control form--control" type="text" name="name"
                                        placeholder="@lang('Ticket Type Name')" required value="{{ old('name') }}"
                                        aria-label="readonly input example" readonly>
                                </div>
                                <div class="form-group">
                                    <div class="input-group mb-3 mt-3">
                                        <span class="input-group-text"
                                            style="
                                                border-top-left-radius: 5px;border-bottom-left-radius:5px;">{{ $priceCurriency->symbol }}</span>
                                        <input type="number" class="form-control d-none" min="0" id="doller-input"
                                            placeholder="Price" name="priceCurriency_id" value="{{ $priceCurriency->id }}">
                                        <input type="number" class="form-control" min="0" id="doller-input"
                                            placeholder="Price" name="price">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>@lang('Ticket Type Description')</label>
                                    <textarea class="form-control form--control" type="text" name="description" rows="4" cols="50" required
                                        value="{{ old('ticket_description') }}" style="height: 140px;" placeholder="@lang('Ticket Type Description')"></textarea>
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
@push('css')
    <style>
        td {
            font-size: 20px;
        }
    </style>
@endpush
