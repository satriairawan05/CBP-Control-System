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
                            <a href="{{ route('report.create') }}" class="btn btn-sm btn-success"><i
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
                                    <th>Project</th>
                                    <th>Task</th>
                                    <th>Code</th>
                                    <th>Message</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reports as $rep)
                                    @php
                                        // $iterationNumber = ($tasks->currentPage() - 1) * $tasks->perPage() + $loop->iteration;
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $rep->project->code }}</td>
                                        <td>{{ $rep->task->code }}</td>
                                        <td>{{ $rep->code }}</td>
                                        <td>{!! $rep->message !!}</td>
                                        <td><span class="badge @if($rep->status == 'Done') badge-dark @else badge-danger @endif">{{ $rep->status }}</span></td>
                                        <td>
                                            @if ($update == 1)
                                                <a href="{{ route('report.edit', $rep->id) }}"
                                                    class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                            @endif
                                            @if ($delete == 1)
                                                <form action="{{ route('report.destroy', $rep->id) }}" method="post"
                                                    class="d-inline">
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
                                    <th>Project</th>
                                    <th>Task</th>
                                    <th>Code</th>
                                    <th>Message</th>
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
