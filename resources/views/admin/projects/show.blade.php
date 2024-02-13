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
                <li><a href="{{ route('project.index') }}" class="text-decoration-none">{{ $name . 's' }}</a></li>
                <li><span>{{ $project->title }}</span></li>
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
                <div class="card-body text-dark text-center">
                    <div class="row">
                        <div class="col-12">
                            <h1 class="fs-2 font-weight-bold">{{ $project->title }}</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <p>Code : <span class="badge badge-dark">{{ $project->code ?? 'Not Found' }}</span></p>
                            <p>Type : {{ $project->type }}</p>
                        </div>
                        <div class="col-6">
                            <p>Owner : {{ $project->created_by }}</p>
                            <p>Size : {{ $project->size }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <p>Summary</p>
                            <p>{!! $project->summary !!}</p>
                        </div>
                        <div class="col-6">
                            <p>Description</p>
                            <p>{!! $project->description !!}</p>
                        </div>
                    </div>
                    @if ($taskCount > 0)
                        <div class="row">
                            <div class="col-lg-12">
                                <h3 class="font-weight-bold">Task</h3>
                                <table class="table-bordered table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Code</th>
                                            {{-- <th>Feature</th>
                                            <th>Summary</th> --}}
                                            <th>price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($project->tasks()->done()->get() as $task)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $task->code }}</td>
                                                {{-- <td>{{ $task->feature }}</td>
                                                <td>{!! $task->summary !!}</td> --}}
                                                <td>Rp. {{ number_format($task->price, 0, ',', '.') }}</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="2">Amount</td>
                                            <td>Rp.
                                                {{ number_format($project->tasks()->done()->sum('price'),0,',','.') }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else
                        <p class="text-danger">There are no completed tasks for this project.</p>
                    @endif

                    @if ($reportCount > 0)
                        <div class="row">
                            <div class="col-lg-12">
                                <h3 class="font-weight-bold">Report</h3>
                                <table class="table-bordered table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Code</th>
                                            <th>price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($project->reports()->done()->get() as $report)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $report->doc_number }}</td>
                                                <td>Rp. {{ number_format($report->price, 0, ',', '.') }}</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="2">Amount</td>
                                            <td>Rp.
                                                {{ number_format($project->reports()->done()->sum('price'),0,',','.') }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else
                        <p class="text-danger">There are no completed reports for this project.</p>
                    @endif

                    <div class="row">
                        <div class="col-12">
                            <h3 class="font-weight-bold">Grand Total</h3>
                            <table class="table-bordered table">
                                <tbody>
                                    <tr>
                                        <th>Task</th>
                                        <td>Rp.{{ number_format($project->tasks()->done()->sum('price'),0,',','.') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Report</th>
                                        <td>Rp.{{ number_format($project->reports()->done()->sum('price'),0,',','.') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Total</th>
                                        <td>Rp.
                                            {{ number_format($project->tasks()->done()->sum('price') +$project->reports()->done()->sum('price'),0,',','.') }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
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
@endpush
