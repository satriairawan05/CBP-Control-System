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
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal"
                                data-bs-target="#addData">
                                <i class="fa fa-plus"></i>
                            </button>

                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="addData" tabindex="-1" aria-labelledby="addDataLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="addDataLabel">Add Approval</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('approval.store') }}"
                                        onsubmit="btnsubmit.disabled=true; return true;" method="post">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <div class="row mb-3">
                                                    <div class="col-6">
                                                        <label for="project_id">Project <span
                                                                class="text-danger">*</span></label>
                                                        <select id="project"
                                                            class="form-control @error('project_id') is-invalid @enderror"
                                                            name="project_id">
                                                            <option value="" selected>Without Project</option>
                                                            @foreach ($project as $d)
                                                                @if (old('project_id') == $d->id)
                                                                    <option value="{{ $d->id }}" selected>
                                                                        {{ $d->title }}
                                                                    </option>
                                                                @else
                                                                    <option value="{{ $d->id }}">{{ $d->title }}
                                                                    </option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                        @error('project_id')
                                                            <div class="invalid-feedback">
                                                                {{ $errors->get('project_id')[0] }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-6">
                                                        <label for="user_id">User <span
                                                                class="text-danger">*</span></label>
                                                        <select id="user"
                                                            class="form-control @error('user_id') is-invalid @enderror"
                                                            name="user_id">
                                                            <option value="" selected>Without User</option>
                                                            @foreach ($user as $d)
                                                                @if (old('user_id') == $d->id)
                                                                    <option value="{{ $d->id }}" selected>
                                                                        {{ $d->name }}
                                                                    </option>
                                                                @else
                                                                    <option value="{{ $d->id }}">
                                                                        {{ $d->name }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                        @error('user_id')
                                                            <div class="invalid-feedback">
                                                                {{ $errors->get('user_id')[0] }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" id="btnsubmit" class="btn btn-primary">Save
                                                changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                    @endif
                    <div class="card-actions mx-5">
                        <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                    </div>
                </div>
                <div class="card-body">
                    @if ($access['read'] == 1)
                        <table class="table-bordered table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Project</th>
                                    <th>User</th>
                                    @if($access['update'] == 1 || $access['delete'] == 1)
                                    <th>Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($approval as $app)
                                    @php
                                        $no = ($approval->currentPage() - 1) * $approval->perPage();
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration + $no }}</td>
                                        <td>{{ $app->project->title }}</td>
                                        <td>{{ $app->user->name }}</td>
                                        @if($access['update'] == 1 || $access['delete'] == 1)
                                        <td>
                                            @if ($access['update'] == 1)
                                                <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#updateData">
                                                    <i class="fa fa-edit"></i>
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="updateData" tabindex="-1"
                                                    aria-labelledby="updateDataLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="updateDataLabel">Update Approval for {{ $app->project->title }}</h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form action="{{ route('approval.update',$app->id) }}"
                                                                onsubmit="btnsubmit.disabled=true; return true;"
                                                                method="post">
                                                                @csrf
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <div class="row mb-3">
                                                                            <div class="col-6">
                                                                                <label for="project_id">Project <span
                                                                                        class="text-danger">*</span></label>
                                                                                <select id="project"
                                                                                    class="form-control @error('project_id') is-invalid @enderror"
                                                                                    name="project_id">
                                                                                    <option value="" selected>Without
                                                                                        Project</option>
                                                                                    @foreach ($project as $d)
                                                                                        @if (old('project_id', $app->project->id) == $d->id)
                                                                                            <option
                                                                                                value="{{ $d->id }}"
                                                                                                selected>
                                                                                                {{ $d->title }}
                                                                                            </option>
                                                                                        @else
                                                                                            <option
                                                                                                value="{{ $d->id }}">
                                                                                                {{ $d->title }}
                                                                                            </option>
                                                                                        @endif
                                                                                    @endforeach
                                                                                </select>
                                                                                @error('project_id')
                                                                                    <div class="invalid-feedback">
                                                                                        {{ $errors->get('project_id')[0] }}
                                                                                    </div>
                                                                                @enderror
                                                                            </div>
                                                                            <div class="col-6">
                                                                                <label for="user_id">User <span
                                                                                        class="text-danger">*</span></label>
                                                                                <select id="user"
                                                                                    class="form-control @error('user_id') is-invalid @enderror"
                                                                                    name="user_id">
                                                                                    <option value="" selected>Without
                                                                                        User</option>
                                                                                    @foreach ($user as $d)
                                                                                        @if (old('user_id',$app->user->id) == $d->id)
                                                                                            <option
                                                                                                value="{{ $d->id }}"
                                                                                                selected>
                                                                                                {{ $d->name }}
                                                                                            </option>
                                                                                        @else
                                                                                            <option
                                                                                                value="{{ $d->id }}">
                                                                                                {{ $d->name }}
                                                                                            </option>
                                                                                        @endif
                                                                                    @endforeach
                                                                                </select>
                                                                                @error('user_id')
                                                                                    <div class="invalid-feedback">
                                                                                        {{ $errors->get('user_id')[0] }}
                                                                                    </div>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" id="btnsubmit"
                                                                        class="btn btn-primary">Save
                                                                        changes</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Modal -->
                                            @endif
                                            @if ($access['delete'] == 1)
                                                <form action="{{ route('approval.destroy', $app->id) }}" method="post"
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
                                    <th>User</th>
                                    @if($access['update'] == 1 || $access['delete'] == 1)
                                    <th>Action</th>
                                    @endif
                                </tr>
                            </tfoot>
                        </table>

                        {{ $approval->links() }}
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
            $('#project').select2({
                dropdownParent: $('#addData')
            });
            $('#user').select2({
                dropdownParent: $('#addData')
            });
        });
    </script>
@endpush
