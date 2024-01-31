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
                <li><a href="{{ route('user.index') }}" class="text-decoration-none">{{ $name . 's' }}</a></li>
                <li><span>Edit</span></li>
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
                    @include('admin.tasks._form', [
                        'submitButton' => 'Submit',
                        'cancelRoute' => route('task.index'),
                        'formAction' => route('task.update',$task->id),
                        'formMethod' => 'PUT',
                        'task' => $task,
                        'project' => $project
                    ])
                </div>
            </div>
        </div>
    </div>
@endsection
