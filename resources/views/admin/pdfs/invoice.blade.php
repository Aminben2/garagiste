<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/bootstrap-extended.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="card">
        <div class="card-body">
            <div id="invoice">
                <div class="invoice overflow-auto">
                    <div style="min-width: 600px">
                        <header>
                            <div class="row">
                                <div class="col">
                                    <a href="javascript:;">
                                        <img src="{{ asset('assets/images/logo-icon.png') }}" alt="image-example"
                                            width="80">
                                    </a>
                                </div>
                                <div class="col company-details">
                                    <h2 class="name">
                                        <a href="javascript:;">
                                            {{ env('/APP_NAME') }}
                                        </a>
                                    </h2>
                                    <div>455 Foggy Heights, AZ 85004, US</div>
                                    <div>(123) 456-789</div>
                                    <div>garagiste@example.com</div>
                                </div>
                            </div>
                        </header>
                        <main>
                            <div class="row contacts">
                                <div class="col invoice-to">
                                    <div class="text-gray-light">INVOICE TO:</div>
                                    <h2 class="to">{{ $invoice->user->firstName }} {{ $invoice->user->lastName }}
                                    </h2>
                                    <div class="address">{{ $invoice->user->address }}</div>
                                    <div class="email"><a
                                            href="mailto:john@example.com">{{ $invoice->user->email }}</a>
                                    </div>
                                </div>
                                <div class="col invoice-details">
                                    <h1 class="invoice-id">INVOICE {{ $invoice->id }}</h1>
                                    <div class="date">Date of Invoice: {{ $invoice->created_at }}</div>
                                    <div class="date">Due Date: {{ $invoice->dueDate }}</div>
                                </div>
                            </div>
                            <table>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="text-left">DESCRIPTION</th>
                                        <th class="text-right">HOUR PRICE</th>
                                        <th class="text-right">HOURS</th>
                                        <th class="text-right">TOTAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Repairs --}}
                                    @foreach ($repairs as $r)
                                        <tr>
                                            <td class="no">{{ $r->id }}</td>
                                            <td class="text-left">
                                                <h3 style="display: block">
                                                    <a href="{{ route('repair.details', ['repair' => $r]) }}">
                                                        {{ $r->title }}
                                                    </a>
                                                </h3>
                                                {{ $r->description }}
                                            </td>
                                            <td class="unit">{{ $r->hourPrice }}</td>
                                            <td class="qty">{{ $r->hours }}</td>
                                            <td class="total">{{ $r->hourPrice * $r->hours }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td colspan="2">SUBTOTAL</td>
                                        <td>{{ $invoice->totalAmount }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td colspan="2">TAX 25%</td>
                                        <td>{{ $invoice->additionalCharges }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td colspan="2">GRAND TOTAL</td>
                                        <td>{{ $invoice->additionalCharges + $invoice->totalAmount }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="thanks">Thank you!</div>
                            <div class="notices">
                                <div>NOTICE:</div>
                                <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30
                                    days.
                                </div>
                            </div>
                        </main>
                        <footer>Invoice was created on a computer and is valid without the signature and seal.</footer>
                    </div>
                    <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
                    <div></div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
