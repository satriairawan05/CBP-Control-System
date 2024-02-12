<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $contract->project->title }}</title>
    <link rel="icon" href="{{ asset('img/logo-white.png') }}" type="image/gif" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
</head>

<body class="container">
    <table class="mt-3" style="max-width: 100%">
        <thead>
            <tr>
                <td width="20%">
                    <img src="{{ asset('img/logo.png') }}" alt="{{ env('APP_URL') }}">
                </td>
                <td width="80%" class="tr">
                    <h1><b>{{ env('APP_NAME') }}</b></h1>
                    <h6>Alamat : Jalan Pemuda 1, Sungai Pinang.</h6>
                    <h6>Samarinda (Kalimantan Timur) Kode Pos 75242</h6>
                    <h6>Email: {{ env('ADMIN_EMAIL') }}</h6>
                    <h6>Telp. {{ env('ADMIN_PHONE') }}</h6>
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="2">
                    <div style="border: 4px solid black;"></div>
                </td>
            </tr>
        </tbody>
    </table>
    <table class="mt-2">
        <thead>
            <tr>
                <th class="text-center">
                    <h2>Surat Perjanjian Kerja Sama</h2>
                    <h3>{{ $contract?->project->title }}</h3>
                </th>
            </tr>
        </thead>
    </table>
    <div class="row mt-2">
        <div class="col-12 text-center">
            <p>Yang bertanda Tangan dibawah ini:</p>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-6">
            <p>1. Nama : {{ $contract->firstParty->name }}</p>
            <p>&nbsp;&nbsp;&nbsp; Email : {{ $contract->firstParty->email }}</p>
            <p>&nbsp;&nbsp;&nbsp; Alamat : {{ $contract->firstParty->address }}</p>
            <p>&nbsp;&nbsp;&nbsp; No HP : {{ $contract->firstParty->phone_number }}</p>
            <p>Dalam Hal ini bertindak atas nama SamariCode dan selanjutnya disebut sebagai <b>Pihak Pertama</b></p>
        </div>
        <div class="col-6">
            <p>2. Nama : {{ $contract->secondParty->name }}</p>
            <p>&nbsp;&nbsp;&nbsp; Email : {{ $contract->secondParty->email }}</p>
            <p>&nbsp;&nbsp;&nbsp; Alamat : {{ $contract->secondParty->address }}</p>
            <p>&nbsp;&nbsp;&nbsp; No HP : {{ $contract->secondParty->phone_number }}</p>
            <p>Dalam Hal ini bertindak atas nama Pribadi dan selanjutnya disebut sebagai <b>Pihak Kedua</b></p>
        </div>
    </div>
    @foreach ($contract->contractDetails as $detail)
        <div class="row">
            <div class="col-12 mt-2 text-center">
                <b>Pasal {{ $detail->pasal }}</b>
                <p>{{ $detail->title }}</p>
                <p>{{ $detail->description }}</p>
            </div>
        </div>
    @endforeach
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/print.js') }}"></script>
</body>

</html>
