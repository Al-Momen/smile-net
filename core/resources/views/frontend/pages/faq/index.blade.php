@extends('frontend.master')
@section('content')
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                    Start Banner Section
                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section class="ticket-banner  bg-overlay-base">
        @if ($site_image->image ?? '')
            <img class="img-fluid"
                src="{{ asset('core\storage\app\public\manage-site\\' . $site_image->image) }} "alt="banner image">
        @endif
    </section>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                    End Banner Section
                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->


    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                    Start FAQ Section
                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->


    <section class="my-5">
        <div class="container mx-auto">
            <div>
                <h3 class="text-white text-center py-5">FAQ</h3>
            </div>
            <div class="accordion accordion-flush" id="accordionFlushExample">
                @foreach ($allFaq as $item)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-heading{{$item->id}}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapse{{$item->id}}" aria-expanded="false" aria-controls="flush-collapse{{$item->id}}">
                                {{ $item->question }}
                            </button>
                        </h2>
                        <div id="flush-collapse{{$item->id}}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{$item->id}}"
                            data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">{!! $item->ans !!}</div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>



    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                    End faq Section
                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
@endsection
@push('css')
    <style>
        .accordion-item {
            background-image: linear-gradient(to right top, #1c2636, #1f2536, #232436, #262335, #2a2234) !important;
            color: #ffffff !important;
        }

        .accordion-button:not(.collapsed) {
            background-image: linear-gradient(to right top, #1c2636, #1f2536, #232436, #262335, #2a2234) !important;
            color: #ffffff !important;
        }

        .accordion-flush .accordion-item .accordion-button {
            background-image: linear-gradient(to right top, #1c2636, #1f2536, #232436, #262335, #2a2234) !important;
            color: #ffffff !important;
        }

        .accordion-button.collapsed::after {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23fff'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e") !important;
        }
    </style>
@endpush
@push('js')
    <script></script>
@endpush
