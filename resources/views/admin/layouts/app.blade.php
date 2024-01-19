<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }} || Dashboard</title>
    @livewireStyles
    @vite(['resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.css') }}">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-center align-items-center">
                    <h1>{{ auth()->user()->name }}</h1>
                </div>
                <div class="d-flex justify-content-center align-items-center">
                    <form action="{{ route('logout') }}" method="post" onsubmit="btnsubmit.disabled=true; return true;">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-dark" id="btnsubmit">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    {{-- @livewireScripts --}}
    @livewireScriptConfig
</body>

</html>
