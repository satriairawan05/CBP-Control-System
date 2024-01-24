@extends('admin.layouts.app')

@php
    foreach ($pages as $r) {
        if ($r->page_name == $name) {
            if ($r->action == 'Create') {
                $create = $r->access;
            }

            if ($r->action == 'Read') {
                $read = $r->access;
            }

            if ($r->action == 'Update') {
                $update = $r->access;
            }

            if ($r->action == 'Delete') {
                $delete = $r->access;
            }
        }
    }
@endphp

@section('breadcrumb')
    <header class="page-header">
        <h2>{{ $name }}</h2>
        <div class="right-wrapper text-end">
            <ol class="breadcrumbs">
                <li>
                    <a href="{{ route('home') }}">
                        <i class="bx bx-home-alt"></i>
                    </a>
                </li>
                <li><span>{{ $name }}</span></li>
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
                            <a href="{{ route('user.create') }}" class="btn btn-sm btn-success"><i
                                    class="fa fa-plus"></i></a>
                        </div>
                    @endif
                </div>
                @if ($read == 1)
                    <div class="card-body">
                        <table class="table-bordered table" id="myTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>NIK</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    @php
                                        // $iterationNumber = ($users->currentPage() - 1) * $users->perPage() + $loop->iteration;
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->nik ?? 'Not Found' }}</td>
                                        <td>{{ $user->group_name ?? 'Not Found' }}</td>
                                        <td>
                                            @if ($update == 1)
                                                <a href="{{ route('user.edit', $user->id) }}"
                                                    class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                            @endif
                                            @if ($delete == 1)
                                                <form action="{{ route('user.destroy', $user->id) }}" method="post"
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
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/media/css/dataTables.bootstrap5.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">
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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/vendor/datatables/media/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#myTable").dataTable({
                "responsive": true,
                "columnDefs": [{
                    "sortable": true
                }]
            });
        });
    </script>
@endpush
