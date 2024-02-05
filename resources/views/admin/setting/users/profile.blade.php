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
                <li><span>{{ $userName }}</span></li>
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
                        <div class="col-2">
                            <img src="{{ $user->image ? asset('storage/' . $user->image) : asset('img/profile.png') }}"
                                alt="{{ $user->name }}" class="img-fluid img-thumbnail w-100 bg-dark">
                        </div>
                        <div class="col-10 text-dark">
                            <div class="row">
                                <div class="col-12">
                                    <h1 class="font-weight-bold">Data Diri</h1>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <span>Name :</span>
                                    <span>{{ $user->name }}</span><br>

                                    <span>Email :</span>
                                    <span>{{ $user->email }}</span><br>

                                    <span>Nomor Handphone :</span>
                                    <span>{{ $user->phone_number ?? '-' }}</span><br>
                                </div>
                                <div class="col-6">
                                    <span>Nomor Induk Kependudukan :</span>
                                    <span>{{ $user->nik }}</span><br>

                                    <span>Alamat :</span>
                                    <span>{{ $user->address ?? '-' }}</span><br>

                                </div>
                            </div>
                            <a href="{{ route('user.changeimage', $user->id) }}" class="btn btn-sm btn-dark">Ubah Foto</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
