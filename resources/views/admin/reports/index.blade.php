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
                    @if ($access['create'] == 1)
                        <div class="d-flex justify-content-end mx-auto my-2">
                            <a href="{{ route('report.create') }}" class="btn btn-sm btn-success"><i
                                    class="fa fa-plus"></i></a>
                        </div>
                    @endif
                    <div class="card-actions mx-5">
                        <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                    </div>
                </div>
                <div class="card-body">
                    @if ($access['read'] == 1)
                        <table class="table-bordered table" id="myTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Project</th>
                                    <th>Task</th>
                                    <th>Code</th>
                                    <th>Message</th>
                                    <th>Status</th>
                                    @if ($access['apply'] == 1 || $access['update'] == 1 || $access['delete'] == 1)
                                        <th>Action</th>
                                    @endif
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
                                        <td>{{ $rep->doc_number }}</td>
                                        <td>{!! $rep->message !!}</td>
                                        <td><span
                                                class="badge @if ($rep->status == 'Done') badge-dark @else badge-danger @endif">{{ $rep->status }}</span>
                                        </td>
                                        @if($access['apply'] == 1 || $access['update'] == 1 || $access['delete'] == 1)
                                        <td>
                                            @php
                                                $apply = \App\Models\Approval::where('project_id', $rep->project->id)->first();
                                            @endphp
                                            @if ($access['apply'] == 1 && $apply?->user->name)
                                                <button class="btn btn-sm btn-dark" data-bs-toggle="modal"
                                                    data-bs-target="#modal">
                                                    <i class="fa fa-pen-alt"></i>
                                                </button>

                                                <div class="modal fade" id="modal" tabindex="-1"
                                                    aria-labelledby="modalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="modalLabel">
                                                                    {{ $rep->doc_number }}
                                                                </h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form action="{{ route('report.updateApproval', $rep->id) }}"
                                                                method="post">
                                                                <div class="modal-body">
                                                                    @csrf
                                                                    @method('put')
                                                                    <div class="row">
                                                                        <div class="col-6">
                                                                            <label for="status">Status <span
                                                                                    class="text-danger">*</span> </label>
                                                                            <select id="status"
                                                                                class="form-control @error('status') is-invalid @enderror"
                                                                                name="status">
                                                                                @php
                                                                                    $status = [['status' => 'Approved'], ['status' => 'Done']];
                                                                                @endphp
                                                                                <option value="" selected>Without
                                                                                    Status
                                                                                </option>
                                                                                @foreach ($status as $s)
                                                                                    @if (old('status') == $s['status'])
                                                                                        <option value="{{ $s['status'] }}"
                                                                                            selected>{{ $s['status'] }}
                                                                                        </option>
                                                                                    @else
                                                                                        <option
                                                                                            value="{{ $s['status'] }}">
                                                                                            {{ $s['status'] }}</option>
                                                                                    @endif
                                                                                @endforeach
                                                                            </select>
                                                                            @error('status')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $errors->get('status')[0] }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <label for="budget">Budget </label>
                                                                            <span class="input-grou-text">
                                                                                <input type="text"
                                                                                    class="form-control @error('budget') is-invalid @enderror"
                                                                                    id="budget"
                                                                                    placeholder="Masukan Budget"
                                                                                    value="{{ old('budget', $report->budget ?? '') }}"
                                                                                    name="budget">
                                                                            </span>
                                                                            @error('budget')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $errors->get('budget')[0] }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-dark">Save
                                                                        changes</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($access['update'] == 1)
                                                <a href="{{ route('report.edit', $rep->id) }}"
                                                    class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                            @endif
                                            @if ($access['delete'] == 1)
                                                <form action="{{ route('report.destroy', $rep->id) }}" method="post"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-sm btn-danger"><i
                                                            class="fa fa-trash"></i></button>
                                                </form>
                                            @endif
                                        </td>
                                        @endif
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
                                    @if ($access['apply'] == 1 || $access['update'] == 1 || $access['delete'] == 1)
                                        <th>Action</th>
                                    @endif
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
    <link rel="stylesheet" href="{{ asset('assets/css/table.css') }}">
@endpush

@push('js')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets/js/table.js') }}"></script>
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
