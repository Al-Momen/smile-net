@extends('frontend.master')
@section('content')
    @include('frontend.partials.slider')
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                                     End Banner Section
                                 ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                                    Start New Items Movie Section
                                 ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    @include('frontend.partials.item_section')
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                                    End New Items Movie Section
                                    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                                   Start Top Movie Section
                                   ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    @include('frontend.partials.top_section')
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                                   End Top Movie Section
                              ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                                    Start Coming Soon Movie Section
                                 ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

    @include('frontend.partials.coming_soon_section')

    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                                   End Coming Soon Movie Section
                                 ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                                    Start All Movies Section
                                   ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    @include('frontend.partials.all_section')
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                                    End All Movies Section
                                 ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->


@section('search')
    <form class="m-0" action="" method="">
        <div class="position-relative">
            <div class="dropdown">
                <input class="header-search-input" type="search" placeholder="Search . . . " name="search"
                    class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                    data-bs-toggle="dropdown" aria-expanded="false">
                <span class="las la-search"></span>
                <ul class="dropdown-menu search" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="#">No data found</a></li>
                </ul>
            </div>
        </div>
    </form>
@endsection

@if (isset($access) && $access != null)
    <!-- Modal -->
    <div>
        <div class="modal fade" id="exampleModalCenter" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
            <form class="form-dashboard" action="" method="POST" enctype="multipart/form-data" id="addAccessForm">
                @csrf
                <div class="modal-dialog ">
                    <div class="modal-content"
                        style="  background-image: linear-gradient(to right top, #15243b, #1a2137, #1e1f33, #201c2e, #211a2a);!important;">
                        <div class="modal-header">
                            <h5 class="modal-title text-white" id="addModalLabel">Standard Package choose</h5>
                        </div>
                        <div class="modal-body">
                            <div class="errMsgContainer" style="padding: 20px;">
                            </div>
                            <div class="col-12 pe-4 mb-3">
                                <h6 class="text-center text-white mb-3">Standard Package you have one Item choose</h6>
                            </div>
                            <div class=" col-lg-6 col-md-6 col-12 pe-4 d-none">
                                <div class="radio-item d-flex justify-content-center px-3">
                                    <input type="text" name="user_id"
                                        class="radio-item-two text-white
                                        "value="{{ $access->user_id }}"
                                        required>
                                </div>
                            </div>
                            <div class="col-12 pe-4 d-flex justify-content-center">
                                <div class="radio-item d-flex justify-content-center px-3 mb-3">
                                    <input type="radio" id="movies" name="access" class="radio-item-two"
                                        value="movies" required style="width: 30px">
                                    <label for="#cc" class="ms-2 text-capitalize text-white my-auto">Movies</label>
                                </div>
                                <div class="radio-item d-flex justify-content-center px-3 mb-3">
                                    <input type="radio" id="movies" name="access" class="radio-item-two"
                                        value="music" required style="width: 22px">
                                    <label for="#cc" class="ms-2 text-capitalize text-white my-auto">Music</label>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end m-3">

                                <button type="submit" class="btn btn-primary w-100" id="btn_add">Save</button>

                            </div> <!-- Button trigger modal -->
                        </div>
                    </div>
            </form>
        </div>
    </div>
@endif
@endsection
@if (isset($access) && $access != null)
@push('js')
    <script type="text/javascript">
        $(window).on('load', function() {
            $('#exampleModalCenter').modal('show');
            $(document).on('change', 'input[name="access"]', function(e) {
                let moviesAccess = $(this).val();
                let accessForm = $('form#addAccessForm');

                if (moviesAccess != null) {
                    accessForm.attr('action', "{{ route('user.package.access') }}");
                    console.log(moviesAccess);
                }

            })
        });
    </script>
@endpush
@endif


{{-- ------------- ajax search bar------------- --}}
@push('js')
<script>
    $(document).ready(function() {
        $(document).on("keyup", ".header-search-input", function(event) {
            var data = $(this).val();

            var card = "";
            var manu = $('.dropdown .search');
            event.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('movies.search') }}",
                method: "POST",
                data: {
                    "data": data,
                },
                success: function(res) {
                    if (res.status) {
                        console.log(res.success);
                        var item = res.data;
                        $.each(item, function(index, value) {
                            console.log(index);
                            if (index == 'newItem') {
                                $.each(value, function(index, value) {
                                    card +=
                                        `<li><a class="dropdown-item" href="item/movies/play/${value.id}">${value.name}</a></li>`;
                                })
                                $(manu).html(card);
                            } else if (index == 'topItem') {
                                $.each(value, function(index, value) {
                                    card +=
                                        `<li><a class="dropdown-item" href="top/movies/play/${value.id}">${value.name}</a></li>`;
                                })
                                $(manu).html(card);
                            } else {
                                $.each(value, function(index, value) {
                                    card +=
                                        `<li><a class="dropdown-item" href="comming/soon/movies/play/${value.id}">${value.name}</a></li>`;
                                })
                                $(manu).html(card);
                            }

                            console.log(value.length);

                            // if (value.length == 0) {
                            //     card =
                            //         `<li><a class="dropdown-item" href="">No data found</a></li>`;
                            // }
                        })
                        $(manu).html(card);

                    } else {
                        console.log('error');
                    }
                },
                error: function(err) {
                    let error = err.responseJSON;
                    $.each(error.errors, function(index, value) {
                        console.log(value);

                    });
                }
            });

        })
    })
</script>
@endpush
@push('css')
<style>
    .position-relative .dropdown .dropdown-menu {
        color: black;
        background-color: white;
        width: 260px;
        max-height: 150px;
        overflow-y: hidden;

    }
    .position-relative .dropdown .dropdown-menu a:hover {
        background-color: #f7f7f7;

    }

    .header-section .dropdown-menu li a:hover {
        /* background-color: #f7f7f7; */
    }
</style>
@endpush
