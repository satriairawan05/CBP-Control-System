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
                <li><span>Create</span></li>
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
                <div class="card-body">
                    @include('admin.projects._form', [
                        'submitButton' => 'Submit',
                        'cancelRoute' => route('project.index'),
                        'formAction' => route('project.store'),
                    ])
                </div>
            </div>
        </div>
    </div>
@endsection
