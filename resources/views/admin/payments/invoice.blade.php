<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }}</title>
    <link rel="icon" href="{{ asset('img/logo-white.png') }}" type="image/gif" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.css') }}">
</head>
<style>
    .tr {
        text-align: right;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    @page {
        size: a4;
    }

    @media print {
        @page {
            size: A4 portrait;
        }
    }
</style>

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
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        window.print();
    </script>
</body>

</html>
