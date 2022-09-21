@extends('frontend.master')
@section('content')

<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            Start Banner Section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
  
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            End Banner Section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            Start News Card Section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section class="news-details">
        <div class="container mx-auto py-5">
            <h1 class="text-white fw-bold fs-2 text-uppercase fw-bold text-center pt-3">15 movie blogs fans should
            </h1>
            <hr class="text-danger p-1 rounded mx-auto" style="width: 100px;">
            <img class="w-75 py-3 mx-auto d-block" src="{{asset('assets/frontend/images/news/n-details1.jpg')}}" />
    
            <div style="max-width: 700px; top: -80px;" class="mx-auto text-white">
                <p class="my-2" style="line-height: 2;">Lorem Ipsum is simply dummy text of the printing and
                    typesetting
                    industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                    unknown
                    printer took a galley of type and scrambled it to make a type specimen book. It has survived not
                    only five
                    centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It
                    was
                    popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,
                    and
                    more
                    recently with desktop publishing software like Aldus PageMaker including versions of Lorem
                    Ipsum.
                </p>
                <br>
                <br>
    
                <h3 class="font-weight-bold text-white">#1. What is Lorem Ipsum?</h3>
                <p class="my-2" style="line-height: 2;">Lorem Ipsum is simply dummy text of the printing and
                    typesetting
                    industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                    unknown
                    printer took a galley of type and scrambled it to make a type specimen book. It has survived not
                    only five
                    centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It
                    was
                    popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,
                    and
                    more
                    recently with desktop publishing software like Aldus PageMaker including versions of Lorem
                    Ipsum.
                </p>
    
                <br>
    
                <blockquote class=p-3 font-italic" style="border-left: 4px solid black; line-height: 2;">
                    Lorem
                    Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                    industry's
                    standard dummy text ever since the 1500s</blockquote>
    
                <br>
    
                <p class="my-2" style="line-height: 2;">Lorem Ipsum is simply dummy text of the printing and
                    typesetting
                    industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                    unknown
                    printer took a galley of type and scrambled it to make a type specimen book. It has survived not
                    only five
                    centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It
                    was
                    popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,
                    and
                    more
                    recently with desktop publishing software like Aldus PageMaker including versions of Lorem
                    Ipsum.
                </p>
    
                <div class="my-3">
                    <small>
                        <a href="#" class="text-primary">#bestmovie</a>, <a href="#" class="text-primary">#politics</a>,
                        <a href="#" class="text-primary">#topmovies</a>, <a href="#" class="text-primary">#15movies</a>,
                        <a href="#" class="text-primary">#2022</a>
                    </small>
                </div>
    
                <div class="pt-5">
                    <div>
                        <div class="pb-5 d-flex">
                            <h3 class="text-white pe-3 my-auto">10k</h3>
                            <button class="btn btn-primary text-white"><i class="fas fa-thumbs-up"></i></button>
                        </div>
                        <h3 class="text-uppercase text-white">comments</h3>
                    </div>
                    <form action="" class="pt-3">
                        <div class="mb-3">
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2"
                                    style="height: 100px"></textarea>
                                <label for="floatingTextarea2">Comments</label>
                            </div>
                        </div>
                        <button class="btn btn-primary w-25">Post</button>
                    </form>
    
                    <div class="d-flex cmnt-details mt-5 p-2 bg-primary rounded-3">
                        <img src="{{asset('assets/frontend/images/bookMagazine/user.jpg')}}" class="rounded-circle me-3" alt="">
                        <div>
                            <h6 class="text-white">Jhon Danels</h6>
                            <p class="fs-6 text-white pe-3">Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                Qui,
                                consequuntur repudiandae
                                libero repellat provident quo dolor aliquid </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            End News Card Section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

@endsection














