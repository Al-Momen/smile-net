@extends('admin.layout.master')
@section('content')
    <div class="row">

        <div class="col-lg-12">
            <div class="table-area">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-wrapper table-responsive">
                            <table class="custom-table">
                                <thead>
                                <tr class="custom-table-row">
                                    <th>Name</th>
                                    <th class="text-center">Subject</th>
                                    <th class="text-center">Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                    @forelse($email_templates as $template)
                                    <tr class="custom-table-row">
                                        <td data-label="Name">{{ __($template->name) }}</td>
                                        <td data-label="Subject" class="text-justify">{{ __($template->subj) }}</td>
                                        <td data-label="Status" class="text-center">

                                            @if($template->email_status == 1)
                                            <span class="badge badge--base">Active</span>
                                        @else
                                        <span class="badge badge-danger">Active</span>
                                        @endif
                                        </td>
                                        <td data-label="Action">
                                            <a href="{{ route('admin.email.template.edit', $template->id) }}" class="btn btn--base">
                                                <i class="las la-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card-footer py-4">
                    {{ paginateLinks($email_templates) }}
                </div>


            </div>
        </div>
    </div>
@endsection
