@extends('frontend.deshboard.master')
@section('content')
    <div class="table-content">
        <div class="row">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row">
                <div class="header-title">
                    <h4>Sold Books</h4>
                </div>
                @forelse ($sold_book_history as $books)
                    <div class="col-12">
                        <div class="card mb-3">
                            <div class="card-text mt-2">
                                <div class="d-flex justify-content-between rec-box-text align-items-center">
                                    <div class="d-flex ">
                                        <i class="fa-solid fa-book-open"></i>
                                        <div class="">
                                            <h4 class="text-capitalize">Books</h4>
                                            <span class="text-capitalize">Books: {{ $books->book->title ?? ' ' }}</span>
                                            <br>
                                            <span class="">TRX No: {{ $books->transaction_id ?? ' ' }}</span>
                                            <br>
                                            <span class="">Gateway: {{ $books->payment_getway ?? ' ' }}</span>
                                        </div>
                                    </div>
                                    <div class="">
                                        <span>
                                            <span class="">Paid Price: {{ $books->paid_price ?? ' ' }}
                                                {{ $currency->symbol ?? ' ' }} </span>
                                            <br>
                                            <span class="">Charge: {{ $books->charge ?? ' ' }} {{ $currency->symbol ?? ' ' }}
                                            </span>
                                            <br>
                                            @if ($books->discount != 0)
                                                <span class="">Discount: {{ $books->discount ?? ' ' }}
                                                    {{ $currency->symbol ?? ' ' }} </span>
                                                <br>
                                            @endif
                                            <span class="">Total Price: {{ $books->final_amo ?? ' ' }}
                                                {{ $currency->symbol ?? ' ' }} </span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="card mb-3 card-text">
                            <div class="card-text text-center">
                                <span class="text-capitalize text-center">{{ $empty_message }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-center text-white">

                    </div>
                @endforelse
            </div>
            {{ $sold_book_history->links() }}
        </div>
    </div>
@endsection
