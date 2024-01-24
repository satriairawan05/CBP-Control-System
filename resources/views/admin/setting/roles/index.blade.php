@extends('admin.layouts.app')

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
                    <div class="d-flex justify-content-end mx-3 my-2">
                        <a href="{{ route('role.create') }}" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table-bordered table">
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
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
