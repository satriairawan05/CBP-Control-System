@extends('admin.layouts.app')

@section('breadcrumb')
    <header class="page-header">
        <h2>{{ $name . 's' }}</h2>
        <div class="right-wrapper text-end">
            <ol class="breadcrumbs">
                <li>
                    <a href="{{ route('home') }}">
                        <i class="bx bx-home-alt"></i>
                    </a>
                </li>
                <li><span>{{ $name . 's' }}</span></li>
            </ol>
            <div class="sidebar-right-toggle">
            </div>
        </div>
    </header>
@endsection

@section('app')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    @if ($create == 1)
                        <div class="d-flex justify-content-end mx-3 my-2">
                            <a href="{{ route('project.create') }}" class="btn btn-sm btn-success"><i
                                    class="fa fa-plus"></i></a>
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    @if ($read == 1)
                        <table class="table-bordered table" id="myTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Code</th>
                                    <th>Title</th>
                                    <th>Summary</th>
                                    <th>Deadline</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projects as $project)
                                    @php
                                        // $iterationNumber = ($projects->currentPage() - 1) * $projects->perPage() + $loop->iteration;
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $project->code ?? 'Not Found' }}</td>
                                        <td>{{ $project->title }}</td>
                                        <td>{!! $project->summary !!}</td>
                                        <td>{{ \Carbon\Carbon::parse($project->deadline)->format('l, d F Y') }}</td>
                                        <td><span
                                                class="badge @if ($project->type == 'Skripsi') badge-dark @else badge-danger @endif">{{ $project->type }}</span>
                                        </td>
                                        <td><span
                                                class="badge @if ($project->status == 'Completed') badge-dark @else badge-danger @endif">{{ $project->status }}</span>
                                        </td>
                                        <td class="d-inline-block">
                                            <a href="{{ route('project.show',$project->id) }}" class="btn btn-sm btn-info"><i class="fa fa-file"></i></a>
                                            @if ($update == 1)
                                                <a href="{{ route('project.edit', $project->id) }}"
                                                    class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                            @endif
                                            @if ($delete == 1)
                                                <form action="{{ route('project.destroy', $project->id) }}"
                                                    method="post" class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-sm btn-danger"><i
                                                            class="fa fa-trash"></i></button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Code</th>
                                    <th>Title</th>
                                    <th>Summary</th>
                                    <th>Deadline</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <style>
        /* Android */
        @media (max-width: 767px) {
            #myTable_wrapper {
                overflow-x: auto;
            }

            #myTable {
                width: 100%;
                white-space: nowrap;
            }
        }

        /* Tablet (landscape) */
        @media (min-width: 768px) and (max-width: 991px) {
            #myTable_wrapper {
                overflow-x: auto;
            }

            #myTable {
                width: 100%;
                white-space: nowrap;
            }
        }

        /* iPhone (portrait) */
        @media (max-width: 767px) and (orientation: portrait) {
            #myTable_wrapper {
                overflow-x: auto;
            }

            #myTable {
                width: 100%;
                white-space: nowrap;
            }
        }

        /* iPhone (landscape) */
        @media (max-width: 991px) and (orientation: landscape) {
            #myTable_wrapper {
                overflow-x: auto;
            }

            #myTable {
                width: 100%;
                white-space: nowrap;
            }
        }
    </style>
@endpush

@push('js')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#myTable').DataTable();
        })
    </script>
    {{-- <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ url()->current() }}',
                    type: 'GET',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                },
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'nik',
                        name: 'nik'
                    },
                    {
                        data: 'group_name',
                        name: 'role',
                        render: function(data, type, row, meta) {
                            if (data) {
                                return '<span class="badge badge-dark">' + data + '</span>';
                            } else {
                                return '-';
                            }
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
            });


            $('#myTable_filter input').on('keyup', function() {
                table.draw();
            });
        });
    </script> --}}
@endpush
