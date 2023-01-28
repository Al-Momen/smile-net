@extends('frontend.master')

@push('css')
    <style>
        .btn--base {
            position: relative;
            background: #009b91;
            border: 1px solid #009b91;
            border-radius: 999px;
            color: #ffffff;
            padding: 12px 30px;
            font-size: 13px;
            font-weight: 500;
            text-align: center;
            text-transform: uppercase;
            -webkit-transition: all ease 0.5s;
            transition: all ease 0.5s;
            text-decoration: none;
        }

        .btn--base,
        .btn--base:focus,
        .btn--base:hover {
            text-decoration: none;
            color: inherit;
        }
    </style>
@endpush

@section('content')
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                    Start 404 Page
                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section class="error mt-5">
        <div class="container py-5 container-xl mx-auto">
            <div class="row content justify-content-center align-items-center">
                <div class="col-lg-12 text-center">
                    <img src="{{ asset('assets/images/errors/404.png') }}" alt="error" />
                    <h3 class="title text-white"><span>Oops!</span> That page can't be found</h3>
                    <p class="text-white">
                        The page you are looking for might have been removed had its name
                        changed or is temporarily unavailable.
                    </p>
                    <a href="{{route('index')}}" class="btn--base btn--base-e mt-5 text-white">
                        <i class="fas fa-arrow-alt-circle-left pe-2"></i>Go Back to Home</a>
                </div>
            </div>
        </div>
    </section>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                    End 404 Page
                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->



    {{-- <section>
        <div class="container py-5">
           
            <div class="row pt-3 g-5">
                @foreach ($all_topMovies as $item)
                    <div class="col-12 col-lg-3 col-md-6">
                        <div class="card shadow-lg">
                            <div class="subscription-premium">
                                <h3 class="text-white text-uppercase">{{ $item->ticketType->name ?? ''}}</h3>
                            </div>
                            <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                                <img src="{{ asset('core\storage\app\public\top-movies\photo\\' . $item->image ?? '') }}" class="img-fluid" />
                            </div>
                            <div class="card-body">
                                <h5 class="card-title text-white">{{ $item->name }}</h5>
                                <p class="primary-color">{{ $item->category }}</p>
                                <a target="_blank" href ="{{ route('top.movies.play',$item->id,)  }}" class="btn btn-outline-secondary video-btn" >
                                Watch Now
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div style="float: right;">
                    <span>{{$all_topMovies->links()}}</span>
                </div>
            </div>
        </div>
    </section> --}}
@endsection
