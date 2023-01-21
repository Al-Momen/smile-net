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
                    <h4>Buying Books</h4>
                </div>
                @forelse ($buyBooks as $books)
                    <div class="col-12">
                        <div class="card mb-3">
                            <div class="card-text mt-2">
                                <div class="d-flex justify-content-between rec-box-text align-items-center">
                                    <div class="d-flex ">
                                        <i class="fa-solid fa-book-open"></i>
                                        <div class="">
                                            <h4 class="text-capitalize">Books</h4>
                                            <span class="text-capitalize">{{ $books->book->title }}</span>
                                        </div>
                                    </div>
                                    <div class="">
                                        <span>
                                            <a class="btn btn-primary" href="{{ route('user.open.pdf', $books->book->id) }}"
                                                target="_blank">Read</a>
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
            {{$buyBooks->links()}}
        </div>
    </div>
@endsection
