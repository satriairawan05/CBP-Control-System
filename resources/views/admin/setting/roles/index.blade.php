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
                    <div class="d-flex justify-content-end mx-3 my-2">
                        <a href="{{ route('role.create') }}" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table-bordered table" id="myTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($group as $g)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $g->group_name }}</td>
                                    <td>
                                        <a href="{{ route('role.edit', $g->group_id) }}" class="btn btn-sm btn-warning"><i
                                                class="fa fa-edit"></i></a>
                                        @if ($g->group_id != 1)
                                            <form action="{{ route('role.destroy', $g->group_id) }}" method="post"
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
                                <th>No</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('assets/vendor/datatables/media/css/dataTables.bootstrap5.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">
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
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('assets/vendor/datatables/media/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables/media/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#myTable").dataTable({
            "responsive": true
            , "columnDefs": [{
                "sortable": true
            }]
        });
    });
</script>
@endpush
