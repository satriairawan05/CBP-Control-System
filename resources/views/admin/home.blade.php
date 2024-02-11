@extends('admin.layouts.app')

@section('breadcrumb')
    <header class="page-header">
        <h2>Dashboard</h2>
        <div class="right-wrapper text-end">
            <ol class="breadcrumbs">
                <li>
                    <a href="{{ route('home') }}">
                        <i class="bx bx-home-alt"></i>
                    </a>
                </li>
                <li><span>Dashboard</span></li>
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
                    <div class="row">
                        <div class="col-md-4 order-md-2">
                            <img src="{{ asset('img/application.gif') }}" class="w-100" alt="Welcome">
                        </div>
                        <div class="col-md-8 order-md-1 text-dark">
                            <h2>Welcome, {{ auth()->user()->name }}!</h2>
                            <h4>“Untuk menang besar, terkadang Anda harus mengambil risiko yang besar pula.” - Bill Gates
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
