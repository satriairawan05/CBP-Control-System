@extends('admin.layouts.app')

@section('breadcrumb')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $name }}</li>
        </ol>
    </div>
@endsection

@section('app')
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h1>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nulla omnis voluptas aliquam!</h1>
            </div>
        </div>
    </div>
@endsection
