@extends('frontend.master')
@section('content')
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                Start News Card Section
            ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section class="news-details">
        <div class="container mx-auto py-5">
            <h1 class="text-white fw-bold fs-2 text-capitalize fw-bold text-center pt-3">{{ $news->title }}
            </h1>
            <hr class="text-danger p-1 rounded mx-auto" style="width: 100px;">
            <img class="w-75 py-3 mx-auto d-block" src="{{ asset('core\storage\app\public\news\\' . $news->image) }}" />
            <div style="max-width: 830px; top: -80px;" class="mx-auto text-white">
                <div class="d-flex">
                    <div class="mt-4">
                        @if ($news->news_type == 'App\Models\User')
                            <a href="{{ route('news.admin.profile', $news->id) }}">
                                <div class="d-flex align-items-center">
                                    <div class="pe-3">
                                        <img src="{{ asset('core\storage\app\public\admin-profile\\' . $news->admin->adminUser->profile_pic) }}"
                                            alt="" class="rounded-circle img-fluid">
                                    </div>
                                    <div>
                                        {{-- <h4 class="fs-6 text-capitalize text-white">{{ $news->admin->adminUser->first_name }}{{ $news->admin->adminUser->last_name }}<span class="text-primary"
                                                style="font-size: 16px;">-
                                                Profile</span></h4> --}}
                                    </div>
                                </div>
                            </a>
                        @endif
                        @if ($news->news_type == 'App\Models\GeneralUser')
                            <a href="{{ route('news.user.profile', $news->id) }}">
                                <div class="d-flex align-items-center">
                                    <div class="pe-3">
                                        <img src="{{ getImage(imagePath()['profile']['user']['path'] . '/' . $news->user->photo, imagePath()['profile']['user']['size']) }}"
                                            alt="" class="rounded-circle img-fluid" style="width: 455px">
                                    </div>
                                    <div>
                                        {{-- <h4 class="fs-6 text-capitalize text-white">{{ ucwords($news->user->full_name) }}<span class="text-primary"
                                                style="font-size: 16px;">-
                                                Profile</span></h4> --}}
                                    </div>
                                </div>
                            </a>
                        @endif
                    </div>
                    <div>
                        <p class="my-2" style="line-height: 40px;">{!! $news->description !!}</p>
                    </div>
                </div>

                <div class="my-3">
                    <h3 style="color: blue">#Tag</h3>
                    <small>
                        {{ preg_replace('/ /i', ', ', $news->title) }}
                    </small>
                </div>
                <div class="pt-5">
                    <div>
                        <form action="" method="" class="pt-3" id="addNewsLikeForm">
                            <div class="d-none">
                                <div class="pb-5 d-flex">
                                    <input type="text" id="newsLikeId" name="news_id" value="{{ $news->id }}">
                                </div>
                            </div>
                            <div class="pb-5 d-flex">
                                <h3 class="text-white pe-3 my-auto" id="totalLike">{{ $totalLike }}</h3>
                                <button class="btn btn-primary text-white " id="newsLikeButton" type="submit"><i
                                        class="fas fa-thumbs-up"></i></button>
                            </div>
                        </form>
                    </div>

                    <form action="" method="" class="pt-3" id="addNewsCommentForm">
                        @csrf
                        <div class="d-none">
                            <div class="pb-5 d-flex">
                                <input type="text" name="news_id" value="{{ $news->id }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <h3 class="text-uppercase text-white mb-3">comments</h3>
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Leave a comment here" id="newsComment" style="height: 100px" name="comment"></textarea>
                                <label for="newsComment">Comments</label>
                            </div>
                        </div>
                        <button class="btn btn-primary w-25" type="submit">Post</button>
                    </form>
                    <div id="commentShow">
                        @foreach ($newsComments as $comment)
                            <div class="d-flex cmnt-details mt-5 p-2 bg-primary rounded-3">
                                <img src="{{ getImage(imagePath()['profile']['user']['path'] . '/' . $comment->user->photo) }}"
                                    class="rounded-circle me-3" alt="" >
                                <div>
                                    <h6 class="text-white">{{ $comment->user?->full_name }}</h6>
                                    <p class="fs-6 text-white pe-3">{{ $comment->comment }} </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <br>
                    <span style="width: max-content; margin-left: auto;">{{ $newsComments->links() }}</span>
                </div>
            </div>
        </div>
    </section>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                                 End News Card Section
                             ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    @push('css')
        <style>
            .img-fluid {
                height: 70px;
                width: 330px;
            }
        </style>
    @endpush
    @push('js')
        <script>
            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                // ---------------------------News details like ajax----------------------
                $(document).on("submit", "form#addNewsLikeForm", function(event) {
                    event.preventDefault();
                    $.ajax({
                        url: "{{ route('news.like') }}",
                        method: "POST",
                        data: {
                            "like": true,
                            'news_id': $('#newsLikeId').val(),
                        },
                        success: function(res) {
                            if (res.status) {
                                // console.log(res.data);
                                $('#totalLike').html(res.data);
                            } else {
                                alert(res.message)
                            }
                        },
                        error: function(err) {
                            let error = err.responseJSON;
                            $.each(error.errors, function(index, value) {
                                console.log(value);
                                $('#commentShow').append(
                                    '<span class="text-danger">' +
                                    value +
                                    '</span>' + '</br>');
                            });
                        }
                    });
                });

                // ---------------------------News details comment ajax----------------------
                $(document).on("submit", "form#addNewsCommentForm", function(event) {
                    event.preventDefault();
                    $.ajax({
                        url: "{{ route('news.comment') }}",
                        method: "POST",
                        data: new FormData(this),
                        dataType: 'JSON',
                        processData: false,
                        contentType: false,
                        success: function(res) {
                            console.log(res);
                            if (res.status) {
                                $('#addNewsCommentForm').trigger("reset");
                                let photo =
                                    "{{ getImage(imagePath()['profile']['user']['path'] . '/' . ':photo') }}";
                                photo = photo.replace(':photo', res.data.user.photo);
                                $('#commentShow').append(
                                    `
                                        <div class="d-flex cmnt-details mt-5 p-2 bg-primary rounded-3">
                                            <img src="${photo}" class="rounded-circle me-3" alt="${res.data.user.full_name}">
                                            <div>
                                                <h6 class="text-white">${res.data.user.full_name}</h6>
                                                <p class="fs-6 text-white pe-3">${res.data.comment}</p>
                                            </div> 
                                        </div> 
                                    `
                                )
                                toastr.success(res.message);
                            } else {
                                alert(res.message)
                                window.location.href = '{{ route('login') }}';
                            }
                        },
                        error: function(err) {
                            let error = err.responseJSON;
                            $.each(error.errors, function(index, value) {
                                console.log(value);
                                $('#commentShow').append(
                                    '<span class="text-danger">' + value + '</span>' +
                                    '</br>');
                            });
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
