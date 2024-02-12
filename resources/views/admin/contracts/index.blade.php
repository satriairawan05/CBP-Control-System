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
                            <a href="{{ route('contract.create') }}" class="btn btn-sm btn-success"><i
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
                                    <th>Code</th>
                                    @if ($access['update'] == 1 || $access['delete'] == 1)
                                        <th>Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contracts as $contract)
                                    @php
                                        // $iterationNumber = ($contracts->currentPage() - 1) * $contracts->perPage() + $loop->iteration;
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $contract->code }}</td>
                                        @if ($access['update'] == 1 || $access['delete'] == 1)
                                            <td>
                                                <a href="{{ route('contract.show', $contract->id) }}" target="__blank"
                                                    {{-- onclick="print({{ $contract->id }})" --}} class="btn btn-sm btn-success"><i
                                                        class="fa fa-file"></i></a>
                                                @if ($access['update'] == 1)
                                                    <a href="{{ route('contract.edit', $contract->id) }}"
                                                        class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                                @endif
                                                @if ($access['delete'] == 1)
                                                    <form action="{{ route('contract.destroy', $contract->id) }}"
                                                        method="post" class="d-inline">
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
                                    <th>Code</th>
                                    @if ($access['update'] == 1 || $access['delete'] == 1)
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
    <script src="{{ asset('assets/js/table.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            const print = (id) => {
                // Replace ':id' with the actual id value
                const url = `{{ route('contract.show', ':id') }}`.replace(':id', id);

                $.get(url, function(data, status) {
                    const contents = data;

                    const frame1 = $('<iframe />', {
                        name: 'frame1',
                        css: {
                            position: 'absolute',
                            top: '-1000000px'
                        }
                    });

                    $('body').append(frame1);

                    const frameDoc = frame1[0].contentDocument || frame1[0].contentWindow.document;
                    frameDoc.open();
                    frameDoc.write(`
                <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <meta http-equiv="X-UA-Compatible" content="ie=edge">
                    <title>${process.env.APP_NAME}</title>
                    <link rel="icon" href="${asset('img/logo-white.png')}" type="image/gif" />
                </head>
                <body id='bodycontent'>
                    ${contents}
                </body>
                </html>
            `);
                    frameDoc.close();

                    setTimeout(function() {
                        window.frames['frame1'].focus();
                        window.frames['frame1'].print();
                        frame1.remove();
                    }, 1000);
                });
            }
        });
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
