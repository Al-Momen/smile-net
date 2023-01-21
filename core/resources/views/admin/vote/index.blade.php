@extends('admin.layout.master')
@section('title')
    Vote
@endsection
@section('page-name')
    Vote
@endsection
@php
    $roles = userRolePermissionArray();
@endphp

@section('content')
    <div class="dashboard-title-part">
        <h5 class="title">Dashboard</h5>
        <div href="" class="dashboard-path">
            <a href={{ route('admin.dashboard') }}>
                <span class="main-path">Dashboards</span>
            </a>
            <i class="las la-angle-right"></i>
            <a href="#">
                <span class="active-path g-color">Vote</span>
            </a>
        </div>
        <div class="view-prodact">
            <a data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="las la-plus"></i>
                <span>Add Vote</span>
            </a>
        </div>
    </div>
    <div class="table-content">
        <div class="shadow-lg p-4 card-1 my-3">
            <!-- Button trigger modal -->
            <div class="table-wrapper">
                <div class="table-responsive">
                    @php
                        $i = 1;
                    @endphp
                    <table class=" custom-table table text-white rounded mt-5">
                        <thead class="text-center" style="color:#7b8191">
                            <tr>
                                <th scope="col">SI</th>
                                <th scope="col">Vote Name</th>
                                <th scope="col">Category</th>
                                <th scope="col">Vote Image</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-center" style="color:#7b8191">
                            @if ($adminVotes->count() == 0)
                                <tr>
                                    <td colspan="99" class="text-center">No data found</td>
                                </tr>
                            @endif
                            @foreach ($adminVotes as $vote)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td class="text-capitalize">{{ $vote->vote_name }}</td>
                                    <td class="text-capitalize">{{ $vote->category->name }}</td>
                                    <td>
                                        <img class="table-admin-img img-fluid d-block me-auto"
                                            src="{{ asset('core\storage\app\public\votes\\' . $vote->vote_image) }}"
                                            alt="Image">
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.vote.status.edit', $vote->id) }}" method="POST">
                                            @csrf
                                            <label class="switch" id="switch">
                                                <input type="checkbox" name="status"
                                                    @if ($vote->status == 1) checked @endif id="switchInput">
                                                <span class="slider round"></span>
                                            </label>
                                        </form>
                                    </td>
                                    <td>
                                        <a
                                            href="{{ route('admin.vote.destroy', $vote->id) }}"class="btn btn-danger rounded"><i
                                                class="fas fa-trash"></i></a>
                                        {{-- <a href="{{ route('admin.vote.edit', $vote->id) }}" class="btn btn-primary rounded">
                                            <i class="fas fa-edit" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal"></i></a> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $adminVotes->links() }}
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('admin.vote.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="modal-content">
                            <div class="modal-header bg--primary">
                                <h5 class="modal-title text-white">@lang('Add Vote Type')</h5>

                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h5 class="modal-title text-white mb-4">@lang('#Vote')</h5>
                                <div class="form-group">
                                    <label>@lang('Vote Name')</label>
                                    <input class="form-control form--control" type="text" name="vote_name"
                                        placeholder="@lang('Vote Name')" required>
                                </div>
                                <div class="form-group">
                                    <label for="image" class="form-label">@lang('voting Image')</label>
                                    <input type="file" src="" class="form-control px-3 pt-2" name="vote_image"
                                        accept="image/*" id="image"
                                        style="
                                    padding-top: 14px !important;
                                ">
                                </div>
                                <div class="form-group">
                                    <label for="categoty" class="form-label">@lang('Category')</label>
                                    <select class="form-select form-select-md mb-3 text-capitalize"
                                        style="padding: 12px 10px;" aria-label=".form-select-lg example" name="category">
                                        <option value=""> -- </option>
                                        @foreach ($categories as $category)
                                            <option @if ($category->id)  @endif value="{{ $category->id }}">
                                                {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="ticket" class="form-label">@lang('Ticket')</label>
                                    <select class="form-select form-select-md mb-3 text-capitalize"
                                        style="padding: 12px 10px;" aria-label=".form-select-lg example" name="ticket">
                                        <option value=""> -- </option>
                                        @foreach ($tickets as $ticket)
                                            <option @if ($ticket->id)  @endif value="{{ $ticket->id }}">
                                                {{ $ticket->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <div class="form-group">
                                        <h5 class="modal-title text-white mb-4 item-title">@lang('#Item One')</h5>
                                        <label>@lang('Item Name')</label>
                                        <input class="form-control form--control" type="text" name="names[]"
                                            placeholder="@lang('Item One Name')" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="image" class="form-label image-title">@lang('Image One')</label>
                                        <input type="file" src="" class="form-control px-3 pt-2"
                                            name="images[]" accept="image/*" id="image"
                                            style="padding-top: 14px !important;">
                                    </div>
                                </div>
                                <div>
                                    <div class="form-group">
                                        <h5 class="modal-title text-white mb-4 item-title">@lang('#Item Two')</h5>
                                        <label>@lang('Item Two Name')</label>
                                        <input class="form-control form--control" type="text" name="names[]"
                                            placeholder="@lang('Item Two Name')">
                                    </div>

                                    <div class="form-group">
                                        <label for="image" class="form-label image-title">@lang('Image Two')</label>
                                        <input type="file" src="" class="form-control px-3 pt-2"
                                            name="images[]" accept="image/*"
                                            id="image"style="padding-top: 14px !important;">
                                    </div>
                                </div>
                                <div id="newVoteAppend">

                                </div>
                                <div class="form-group text-center">
                                    <button class="btn btn-success" id="addNewVote">Add Vote</button>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <style>
        .table-admin-img {
            height: 60px;
            width: 60px;
            border-radius: 70px;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 40px;
            height: 24px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: -10px;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .8s;
        }

        input:checked+.slider {
            background-color: #2196F3;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>
@endsection
@section('scripts')
    <script>
        $('.switch').click(function() {
            $(this).parents('form').submit();
        })
    </script>
    <script>
        $(document).on('click', '#addNewVote', function(e) {
            e.preventDefault();
            let item = $(".item-title");
            itemLength = item.length + 1;
            var list = {
                1: "One",
                2: "Two",
                3: "Three",
                4: "Four",
                5: "Five",
                6: "Six",
                7: "Seven",
                8: "Eight",
                9: "Nine",
                10: "Ten",
            };

            let check = true;
            Object.keys(list).forEach((index, element) => {
                console.log(index);
                if (check === true) {
                    if (index == itemLength) {
                        item = list[itemLength];
                        check = false;
                    } else {
                        item = itemLength;
                    }
                }
            });

            $("#newVoteAppend").append(`
                <div class="item-wrp"> 
                    <div class="form-group ">
                        <div class="d-flex justify-content-between">
                            <h5 class="modal-title text-white mb-4 item-title">@lang('#Item ${item}')</h5>
                            <button type="button" class="btn-close bg-danger p-2" aria-label="Close"></button>
                        </div>
                        <label>@lang('Item Two Name')</label>
                        <input class="form-control form--control" type="text" name="names[]"
                        placeholder="@lang('Item Two Name')" required >
                    </div>

                    <div class="form-group">
                        <label for="image" class="form-label image-title">@lang('Image ${item}')</label>
                        <input type="file" src="" class="form-control px-3 pt-2"
                            name="images[]" accept="image/*"  "id="image"style="padding-top: 14px !important;">
                    </div>
                
                </div>
            `);
        });
        $(document).on('click', '.btn-close', function(e) {
            e.preventDefault();
            $(this).parent().parent().parent().remove();
        });
    </script>
@endsection
