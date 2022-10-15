@extends('admin.layout.master')
@section('title')
    Category
@endsection
@section('page-name')
    Category
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
                <span class="active-path g-color">Ticket Type</span>
            </a>
        </div>
        <div class="view-prodact">
            <a data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="las la-plus"></i>
                <span>Add Ticket Type</span>
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
                                <th scope="col">Ticket Type Name</th>
                                <th scope="col">Ticket Type Description</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @if ($ticketTypes->count() == 0)
                                <tr>
                                    <td colspan="99">No data found</td>
                                </tr>
                            @endif
                            @foreach ($ticketTypes as $ticketType)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td class="text-capitalize">{{ $ticketType->name }}</td>
                                    <td>{{ $ticketType->description }}</td>
                                    <td>
                                        <a
                                            href="{{ route('admin.ticket.type.destroy', $ticketType->id) }}"class="btn btn-danger rounded"><i
                                                class="fas fa-trash"></i></a>
                                        <a href="{{ route('admin.ticket.type.edit', $ticketType->id) }}"
                                            class="btn btn-primary rounded"> <i class="fas fa-edit" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$ticketTypes->links()}}
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
                                        placeholder="@lang('Ticket Type Name')" required value="{{ old('name') }}">
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
