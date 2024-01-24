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
                <li><a href="{{ route('user.index') }}" class="text-decoration-none">{{ $name }}</a></li>
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
                    @include('admin.setting.users._form',[
                        'submitButton' => 'Submit',
                        'cancelRoute'=> route('user.index'),
                        'formAction'=>route('user.store'),
                    ])
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('assets/vendor/select2/css/select2.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/select2-bootstrap-theme/select2-bootstrap.min.css') }}">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css') }}">
<style type="text/css">
    #showHidePassword {
        position: relative;
    }

    #togglePassword,
    #togglePasswordConfirm {
        position: absolute;
        top: 50%;
        right: 6px;
        transform: translateY(-50%);
        cursor: pointer;
    }

</style>
@endpush

@push('js')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="{{ asset('assets/vendor/select2/js/select2.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('assets/vendor/jquery-maskedinput/jquery.maskedinput.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/auth.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#group').select2();
    });
</script>
@endpush
