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
                <li><a href="{{ route('role.index') }}" class="text-decoration-none">{{ $name }}</a></li>
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
                    @include('admin.setting.roles._form', [
                        'formAction' => route('role.store'),
                        'cancelRoute' => route('role.index'),
                        'submitButton' => 'Submit',
                        'page_distincts' => $page_distincts,
                        'pages' => $pages,
                    ]);
                </div>
            </div>
        </div>
    </div>
@endsection
