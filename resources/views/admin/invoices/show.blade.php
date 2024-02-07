<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $invoice->project->title }} / {{ $invoice->code }}</title>
    <link rel="icon" href="{{ asset('img/logo-white.png') }}" type="image/gif" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
</head>

<body class="container">
    <table class="mt-3" style="max-width: 100%">
        <thead>
            <tr>
                <td width="20%">
                    <img src="{{ asset('img/logo.png') }}" alt="{{ env('APP_NAME') }}">
                </td>
                <td width="80%" class="tr">
                    <h1 class="font-weight-bold">Invoice</h1>
                    <h6>Invoice: {{ $invoice->code }}</h6>
                    <h6>Effective Date: {{ \Carbon\Carbon::parse($invoice->effective_date)->isoFormat('DD MMMM YYYY') }}
                    </h6>
                    <h6>Expire Date: {{ \Carbon\Carbon::parse($invoice->expiration_date)->isoFormat('DD MMMM YYYY') }}
                    </h6>
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
    <div class="row mt-2">
        <div class="col-6 text-left">
            <h3><b>Invoice To :</b></h3>
            <h6>{{ $invoice->secondParty->name }}</h6>
            <h6>{{ $invoice->secondParty->address }}</h6>
            <h6>{{ $invoice->secondParty->email }}</h6>
            <h6>{{ $invoice->secondParty->phone_number }}</h6>
        </div>
        <div class="col-6" style="text-align: right;">
            <h3><b>Pay To :</b></h3>
            <h6>{{ $invoice->firstParty->name }}</h6>
            <h6>{{ $invoice->firstParty->address }}</h6>
            <h6>{{ $invoice->firstParty->email }}</h6>
            <h6>{{ $invoice->firstParty->phone_number }}</h6>
        </div>
    </div>
    <table class="my-3 table">
        <thead id="pm">
            <tr>
                <th class="text-left">Payment Method</th>
                @if ($invoice->account_number != null)
                    <th style="text-align: right;">Account Number</th>
                @endif
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-left">{{ $invoice->payment }}</td>
                @if ($invoice->account_number != null)
                    <td style="text-align: right;">{{ $invoice->account_number }}</td>
                @endif
            </tr>
        </tbody>
    </table>
    <table class="my-2 table">
        <thead id="item">
            <tr>
                <th class="text-left">Item</th>
                <th>Code</th>
                <th style="text-align: right;">Price</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-left" id="project" colspan="2">Project</td>
                <td style="text-align: right;"></td>
            </tr>
            <tr>
                <td class="text-left">{{ $invoice->project->title }}</td>
                <td class="text-left">{{ $invoice->project->code }}</td>
                <td style="text-align: right;"></td>
            </tr>
            @if ($invoice->project->tasks != null)
                <tr>
                    <td class="text-left" id="task" colspan="2">Task</td>
                    <td style="text-align: right;"></td>
                </tr>
                @foreach ($invoice->project->tasks()->where('status', 'Done')->get() as $task)
                    <tr>
                        <td class="text-left">{{ $task->feature }}</td>
                        <td>{{ $task->code }}</td>
                        <td style="text-align: right;">Rp. {{ number_format($task->budget, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            @endif
            @if ($invoice->project->reports != null)
                <tr>
                    <td class="text-left" id="report" colspan="2">Report</td>
                    <td style="text-align: right;"></td>
                </tr>
                @foreach ($invoice->project->reports()->where('status', 'Done')->get() as $report)
                    <tr>
                        <td class="text-left">{{ $report->task->feature }}</td>
                        <td>{{ $report->doc_number }}</td>
                        <td style="text-align: right;">Rp. {{ number_format($report->budget, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            @endif
            <tr>
                <td class="text-left" colspan="2">Sub Total</td>
                <td style="text-align: right;">
                    Rp.
                    {{ number_format($invoice->project->tasks()->done()->sum('budget') + $invoice->project->reports()->done()->sum('budget'), 0, ',', '.') }}
                </td>
            </tr>
        </tbody>
    </table>
    <table class="my-2 table">
        <thead>
            <tr>
                <td class="text-left" colspan="2">Diskon</td>
                <td style="text-align: right;">
                    Rp.
                </td>
            </tr>
            <tr>
                <td class="text-left" colspan="2">Tax</td>
                <td style="text-align: right;">
                    Rp.
                </td>
            </tr>
            <tr>
                <td class="text-left" colspan="2">Total</td>
                <td style="text-align: right;">
                    Rp.
                    {{ number_format($invoice->project->tasks()->done()->sum('budget') + $invoice->project->reports()->done()->sum('budget'), 0, ',', '.') }}
                </td>
            </tr>
        </thead>
    </table>
    <div class="row my-2">
        <div class="col-6">
            <p><b>Instructions :</b></p>
            <p>Kindly proceed with the payment and confirmation before the specified date.</p>
        </div>
        <div class="col-6">
            <table class="table">
                <tr>
                    <td style="text-align:justify; border: 1px solid black; padding:10px">
                        @php Config::set('terbilang.locale', 'id') @endphp
                        <b>{{ Riskihajar\Terbilang\Facades\Terbilang::make($invoice->project->tasks()->done()->sum('budget') + $invoice->project->reports()->done()->sum('budget'), ' rupiah', 'senilai ') }}</b>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    {{-- <div class="row mt-2">
        <div class="col-6">
            <p><b>1. Copyright Ownersip :</b></p>
            <ul>
                <li>All copyrights to the products or services listed in this invoice are retained by Deuwi Satriya Irawan</li>
                <li>The buyer is granted limited usage rights for personal or business purposes and is not allowed to reproduce, distribute, or use the products or services for commercial purposes without written permission from the copyright owner.</li>
            </ul>
            <p><b>2. Usage of Products or Services :</b></p>
            <ul>
                <li>The buyer is authorized to use the products or services for personal or business purposes.</li>
                <li>Commercial use, reproduction, or distribution is not allowed without written permission from the copyright owner.</li>
            </ul>
            <p><b>3. Copyright Notice</b></p>
            <ul>
                <li>This invoice includes a copyright notice to inform that the products or services are protected by copyright.</li>
                <li>Example: "© [Year] [Company Name]. All Rights Reserved."</li>
            </ul>
            <p><b>4. Return Policy</b></p>
            <ul>
                <li>No returns are accepted for delivered products or services.</li>
                <li>Physical products may be returned within a specified time frame with certain conditions.</li>
            </ul>
        </div>
        <div class="col-6">
            <p><b>5. Copyright Violations</b></p>
            <ul>
                <li>The buyer is responsible for respecting copyright.</li>
                <li>Copyright violations may result in legal action.</li>
            </ul>
            <p><b>6. Updates and Changes</b></p>
            <ul>
                <li>The copyright owner reserves the right to make updates or changes to the products or services without prior notice.</li>
                <li>The buyer has no ownership rights over such updates or changes.</li>
            </ul>
            <p><b>7. Contact Information</b></p>
            <ul>
                <li>Contact information for the copyright owner is available for permission requests or copyright-related inquiries.</li>
            </ul>
        </div>
    </div> --}}

    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/print.js') }}"></script>
</body>

</html>
