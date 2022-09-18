@extends('frontend.deshboard.master')
@section('content')
<div class="table-content">
    <div class="shadow-lg p-4 card-1 my-3">
        <form action="" class="form-dashboard">
            <div class="row g-4k">
                <div class="mb-3 col-lg-6 col-md-6 col-12 pe-4">
                    <label for="text1" class="form-label text-white">Title</label>
                    <input type="text" class="form-control" id="text1" placeholder="Title">
                </div>
                <div class="mb-3 col-lg-6 col-md-6 col-12 pe-4">
                    <label for="text2" class="form-label text-white">Short
                        Description</label>
                    <input type="text" class="form-control" id="text2"
                        placeholder="Short Description">
                </div>
                <div class="mb-3 col-lg-4 col-md-4 col-12 pe-4">
                    <label for="date1" class="form-label text-white">Date</label>
                    <input type="date" class="form-control">
                </div>
                <div class="mb-3 col-lg-4 col-md-4 col-12 pe-4">
                    <label for="" class="form-label text-white">Image</label>
                    <input type="file" class="form-control px-3 pt-2">
                </div>
                <div class="mb-3 col-lg-4 col-md-4 col-12 pe-4">
                    <label for="" class="form-label text-white">Price</label>
                    <input type="text" class="form-control px-3 pt-2" placeholder="Price">
                </div>
                <div class="my-3 col-lg-6 col-md-6 col-12">
                    <button class="btn btn-primary rounded btn w-25">Add</button>
                </div>
            </div>
        </form>

        <div>
            <h3 class="text-white text-capitalize fw-bold pt-5 pb-3">Book</h3>

            <div>
                <table class="table text-white rounded">
                    <thead>
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Price</th>
                            <th scope="col">Date</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Gemini</td>
                            <td>BRUSSELSCIRQUE ROYAL - KONINKLIJK CIRCUS</td>
                            <td>$20</td>
                            <td>17/8/2022</td>
                            <td class="">
                                <i class="fa-solid fa-trash-can btn btn-danger rounded">
                                </i>
                                <i class="fa-solid fa-edit btn btn-primary rounded"
                                    data-bs-toggle="modal" data-bs-target="#exampleModal">
                                </i>
                            </td>
                        </tr>
                        <tr>
                            <td>Gemini</td>
                            <td>BRUSSELSCIRQUE ROYAL - KONINKLIJK CIRCUS</td>
                            <td>$20</td>
                            <td>17/8/2022</td>
                            <td class="">
                                <i class="fa-solid fa-trash-can btn btn-danger rounded">
                                </i>
                                <i class="fa-solid fa-edit btn btn-primary rounded"
                                    data-bs-toggle="modal" data-bs-target="#exampleModal">
                                </i>
                            </td>
                        </tr>
                        <tr>
                            <td>Gemini</td>
                            <td>BRUSSELSCIRQUE ROYAL - KONINKLIJK CIRCUS</td>
                            <td>$20</td>
                            <td>17/8/2022</td>
                            <td class="">
                                <i class="fa-solid fa-trash-can btn btn-danger rounded">
                                </i>
                                <i class="fa-solid fa-edit btn btn-primary rounded"
                                    data-bs-toggle="modal" data-bs-target="#exampleModal">
                                </i>
                            </td>
                        </tr>
                        <tr>
                            <td>Gemini</td>
                            <td>BRUSSELSCIRQUE ROYAL - KONINKLIJK CIRCUS</td>
                            <td>$20</td>
                            <td>17/8/2022</td>
                            <td class="">
                                <i class="fa-solid fa-trash-can btn btn-danger rounded">
                                </i>
                                <i class="fa-solid fa-edit btn btn-primary rounded"
                                    data-bs-toggle="modal" data-bs-target="#exampleModal">
                                </i>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection