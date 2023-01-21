@extends('frontend.deshboard.master')
@section('content')
    <div class="table-content">
        <div class="row">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('success') }}!</strong> <button type="button" class="btn-close" data-bs-dismiss="alert"
                        aria-label="Close"></button>
                </div>
            @endif
            @if (session('info'))
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <strong>{{ session('info') }}!</strong> <button type="button" class="btn-close" data-bs-dismiss="alert"
                        aria-label="Close"></button>
                </div>
            @endif
            <div class="col">
                <table class="table text-white rounded mt-5">
                    <thead class="text-center">
                        <tr>
                            <th scope="col">Serial No</th>
                            <th scope="col">Metting Code</th>
                            <th scope="col">Start Time</th>    
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @if ($meeting_history->count() == 0)
                            <tr>
                                <td colspan="99">No data found</td>
                            </tr>
                        @endif
                        @php
                            $i = 1;
                        @endphp
                        
                        @foreach ($meeting_history as $item)
                            <tr>
                                <td class="">{{ $i++}}</td>
                                <td class="">{{ $item->room_code}}</td>
                                <td class="">
                                    @php
                                        $date = $item->created_at;
                                        echo date('d/m/Y', strtotime($date));
                                    @endphp
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $meeting_history->links() }}
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        .dark-select {
            color: #fff !important;
            border: 1px solid rgba(255, 255, 255, 0.2) !important;
        }
        .dark-select::placeholder {
            color: #fff !important;
        }

        .dark-label {
            color: #fff;
        }
    </style>
@endpush
