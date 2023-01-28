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

    @if (isset($access) && $access != null)
        <!-- Modal -->
        <div>
            <div class="modal fade" id="exampleModalCenter" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="addModalLabel" aria-hidden="true">
                <form class="form-dashboard" action="" method="POST" enctype="multipart/form-data" id="addAccessForm">
                    @csrf
                    <div class="modal-dialog ">
                        <div class="modal-content" style="  background-image: linear-gradient(to right top, #15243b, #1a2137, #1e1f33, #201c2e, #211a2a);!important;">
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
                                        <input type="text" name="user_id" class="radio-item-two text-white
                                        "value="{{ $access->user_id }}" required>
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
                    // console.log(this, $(this).val());
                })
            });
        </script>
    @endpush
@endif
