@extends('admin.layout.master')
@section('title')
    Pricing
@endsection
@section('page-name')
    Pricing
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
                <span class="active-path g-color">Pricing</span>
            </a>
        </div>
        <div class="view-prodact">
            <a data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="las la-plus"></i>
                <span>Add Pricing</span>
            </a>
        </div>
    </div>
    <div class="table-content">
        <div class="shadow-lg p-4 card-1 my-3">
            <div class="table-wrapper table-responsive">
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
                                <th scope="col">Price</th>
                                <th scope="col">Price Symbol</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @if ($allPricing->count() == 0)
                                <tr>
                                    <td colspan="99" class="text-center">No data found</td>
                                </tr>
                            @endif
                            @foreach ($allPricing as $pricing)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td class="text-capitalize">{{ $pricing->ticketType->name }}</td>
                                    <td>{{ $pricing->price }}</td>
                                    <td>{{ $pricing->priceCurrency->symbol }}</td>
                                    <td>
                                        <form action="{{ route('admin.pricing.status.edit', $pricing->id) }}"
                                            method="POST">
                                            @csrf
                                            <label class="switch" id="switch">
                                                <input type="checkbox" name="status"
                                                    @if ($pricing->status == 1) checked @endif id="switchInput">
                                                <span class="slider round"></span>
                                            </label>
                                        </form>
                                    </td>
                                    <td>
                                        <a
                                            href="{{ route('admin.pricing.destroy', $pricing->id) }}"class="btn btn-danger rounded"><i
                                                class="fas fa-trash"></i></a>

                                        <a href="{{ route('admin.edit.pricing', $pricing->id) }}"
                                            class="btn btn-primary rounded"> <i class="fas fa-edit"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $allPricing->links() }}
                </div>
            </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.store.pricing') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="modal-content">

                            <div class="modal-header bg--primary">
                                <h5 class="modal-title text-white">@lang('Add Pricing')</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>

                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="name" class="form-label">@lang('Name')</label>
                                    <input type="text" name="name" id="name" placeholder="Pricing Name">
                                </div>
                                <div class="form-group">
                                    <label for="ticket_type" class="form-label">@lang('Ticket Type')</label>
                                    <select class="form-select form-select-md mb-3 text-capitalize"
                                        style="padding: 12px 10px;" aria-label=".form-select-lg example"
                                        name="ticket_type_id">
                                        <option value=""> -- </option>
                                        @foreach ($ticketTypes as $ticketType)
                                            <option @if ($ticketType->id)  @endif
                                                value="{{ $ticketType->id }}">
                                                {{ $ticketType->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="price_curriency" class="form-label">@lang('Price')</label>
                                    <div class="input-group mb-3 mt-3">
                                        <span class="input-group-text"
                                            style="
                                            border-top-left-radius: 5px;border-bottom-left-radius:5px;">{{ $priceCurrency->symbol }}</span>
                                        <input type="text" class="form-control d-none" min="0" id="doller-input"
                                            name="price_currency_id" value="{{ $priceCurrency->id }}">
                                        <input type="number" class="form-control" min="0" id="doller-input"
                                            placeholder="Price" name="price">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
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
    {{-- toastr --}}
    <script>
        @if (Session::has('success'))
            toastr.success("{{ session('success') }}")
        @endif
    </script>
@endsection
