@extends('admin.layout.master')
@section('title')
    All-Events
@endsection
@section('page-name')
    All-Events
@endsection

@section('search')
    <form class="app-search d-none d-lg-block col p-0" action="" method="post">
        @csrf
        <div class="position-relative">
            <input class="form-control" id="search" type="text" placeholder="Search . . . ." aria-label="Search" name='search'>
            <span class="las la-search"></span>
        </div>
    </form>
@endsection

@section('content')
    <div class="dashboard-title-part">
        <h5 class="title">Dashboard</h5>
        <div href="" class="dashboard-path">
            <a href={{ route('admin.dashboard') }}>
                <span class="main-path">Dashboards</span>
            </a>
            <i class="las la-angle-right"></i>
            <a href="#">
                <span class="active-path g-color">All-Events</span>
            </a>
        </div>
        <div class="view-prodact">


        </div>
    </div>


    <!-- Button trigger modal -->
    <div class="table-content">
        <div class=" card-1 my-3">
            <div class="table-wrapper table-responsive">
                <table class="custom-table table text-white rounded mt-5">
                    <thead class="text-center" style="color:#7b8191">
                        <tr>
                            <th scope="col">User Name</th>
                            <th scope="col">Image</th>
                            <th scope="col">Title</th>
                            <th scope="col">Category Name</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center" style="color:#7b8191">
                        @if ($events->count() == 0)
                            <tr>
                                <td colspan="99" class="text-center">No data found</td>
                            </tr>
                        @endif
                        @foreach ($events as $event)
                            @if ($event->author_event_type == 'App\Models\User')
                                <tr>
                                    <td>
                                        {{ ($event->admin->adminUser->first_name ?? ' ') . ' ' . ($event->admin->adminUser->last_name ?? '') }}
                                    </td>
                                    <td>
                                        <img class="table-user-img img-fluid d-block me-auto"
                                            src="{{ asset('core\storage\app\public\admin-profile\\' . $event->admin->adminUser->profile_pic ?? '') }}"
                                            alt="User Image">
                                    </td>


                                    <td>{{ $event->title ?? '' }}</td>
                                    <td>{{ $event->category->name ?? '' }}</td>
                                    <td>
                                        <form action="{{ route('admin.event.status.edit', $event->id) }}" method="POST">
                                            @csrf
                                            <label class="switch" id="switch">
                                                <input type="checkbox" name="status"
                                                    @if ($event->status == 1) checked @endif id="switchInput">
                                                <span class="slider round"></span>
                                            </label>
                                        </form>
                                    </td>
                                    <td>
                                        <a
                                            href="{{ route('admin.event.destroy', $event->id) }}"class="btn btn-danger rounded"><i
                                                class="fas fa-trash"></i></a>
                                        <a href="{{ route('admin.event.view', $event->id) }}"
                                            class="btn btn-primary rounded">
                                            <i class="fas fa-edit"></i></a>
                                    </td>
                                </tr>
                            @endif
                            @if ($event->author_event_type == 'App\Models\GeneralUser')
                                <tr>
                                    <td>{{ ucfirst($event->user->full_name) }}</td>
                                    <td>
                                        <img class="table-user-img img-fluid d-block me-auto"
                                            src="{{ getImage(imagePath()['profile']['user']['path'] . '/' . $event->user->photo, imagePath()['profile']['user']['size']) }}"
                                            alt="User Image">
                                    </td>
                                    <td>{{ $event->title ?? '' }}</td>
                                    <td>{{ $event->category->name ?? '' }}</td>
                                    <td>
                                        <form action="{{ route('admin.event.status.edit', $event->id) }}" method="POST">
                                            @csrf
                                            <label class="switch" id="switch">
                                                <input type="checkbox" name="status"
                                                    @if ($event->status == 1) checked @endif id="switchInput">
                                                <span class="slider round"></span>
                                            </label>
                                        </form>
                                    </td>
                                    <td>
                                        <a
                                            href="{{ route('admin.event.destroy', $event->id) }}"class="btn btn-danger rounded"><i
                                                class="fas fa-trash"></i></a>
                                        <a href="{{ route('admin.event.view', $event->id) }}"
                                            class="btn btn-primary rounded">
                                            <i class="fas fa-edit"></i></a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
                {{ $events->links() }}
            </div>
        </div>
    </div>


    <!-- Modal -->
@endsection
@section('css')
    <style>
        .table-user-img {
            height: 60px;
            width: 60px;
            border-radius: 70px;
        }

        /* ----------switch css---------- */
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
@endsection
