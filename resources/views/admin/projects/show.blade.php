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
                        </div>
                        <div class="col-6">
                            <p>Owner : {{ $project->created_by }}</p>
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
                </div>
            </div>
        </div>
    </div>
@endsection
