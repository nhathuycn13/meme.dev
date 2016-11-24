<!doctype html>
<html lang="vi">
<head>
    <title>Báo Giá</title>
    <meta charset="UTF-8" />
    <style>
        body{
            font-family: DejaVu Sans;
        }
        .header{
            text-align: center;
        }
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        .table-detail{
            width: 100%;

        }
        .footer{
            margin-top: 40px;
        }
        .footer div{
            width: 50%;
            display: inline-block;
        }
    </style>
</head>

<body>
    <div class="header">
        <h3>{{ $config['fullname'] }}</h3>
        <br>
        {{ $config['address'] }}. <br>
        Tax Code: {{ $config['tax_id'] }}. <br>
        <a href="{{ $config['website'] }}">{{ $config['website'] }}</a> | <a href="mailto:{{ $config['email'] }}">{{ $config['email'] }}</a>
        <hr>
    </div>
    <div class="intro">
        <h1 style="text-align: center">Quotation</h1>
        To: {{ $quote['data']->customer->name }}. <br>
        Company: {{ $quote['data']->customer->company_name }}. <br>
        Address: {{ $quote['data']->customer->address }}.

        <div class="description">
            Dear {{ $quote['data']->customer->name }}, <br>
            First of all, ...
        </div>
    </div>
    <div style="margin-top: 10px;">
        <table class="table-detail">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Part No</th>
                    <th>Material Description</th>
                    <th>Picture</th>
                    <th>Qty</th>
                    <th>Unit Price</th>
                    <th>Subtotal</th>
                    <th>Note</th>
                </tr>
            </thead>
            <tbody>
            @php($total = 0)
            @foreach($quote['data']->orderDetail as $key => $item)
                @php($total += $item->price * $item->qty)
                <tr style="text-align: center;">
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->product->desctiption }}</td>
                    <td><img style="width: 100px;" src="{{ $item->product->thumbnail }}"></td>
                    <td>{{ $item->qty }}</td>
                    <td>{{ $item->price }}</td>
                    <td>{{ $item->qty * $item->price }}</td>
                    <td>{{ $item->description }}</td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="6">Total</th>
                    <th>{{ $total }}</th>
                    <th></th>
                </tr>
                <tr>
                    <th colspan="6">Tax</th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <th colspan="6">Total (included tax)</th>
                    <th>{{ $total }}</th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="footer">
        <div>
            <p>{{ $quote['data']->description }}</p>
            <br>
            Best regard <br>
            <p style="font-weight: bold">{{ $quote['data']->user->name }}</p>
            <p>{{ $quote['data']->user->role }}</p>
        </div>
        <div>
            <div style="text-align: center;width: 100%;">
                <p style="font-weight: bold">Full Customer Confirmation</p>
                <p style="font-style: italic;">(Authorized signature with company stamp)</p>
            </div>



                <p style="font-weight: bold;">Fullname: _________________</p>
                <p style="font-weight: bold">Data: _________________</p>
        </div>
    </div>
</body>
</html>