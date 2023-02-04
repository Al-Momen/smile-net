@push("css")

<style>
    .banner-thumb{
        width: 100%;
        height: 400px;
    }
    .banner-thumb img{
        width: 100%;
        height: 100% !important;
        object-fit: cover;
        /* object-position: center; */
    }
</style>
    
@endpush

<section class="banner overflow-hidden">
    <div class="container-fluid p-0">
        <!-- Swiper -->
        <div class="swiper mySwiper">
            <div class="swiper-wrapper" data-swiper-autoplay="4000">
                @foreach ($site_image as $item)
                    @if ($item->image ?? '')
                        <div class="swiper-slide">
                            <div class="banner-thumb">
                                <img src="{{ asset('core\storage\app\public\manage-site\\' . $item->image) }}"
                                alt="banner image">
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</section>
