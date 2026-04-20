<!DOCTYPE html>
<html>
<head>
    <title>Print Receipt</title>

    <style>
        @media print {
            @page {
                margin: 0;
            }
            body {
                margin: 0;
                font-family: monospace;
                font-size: 14px;
                font-weight: bold;
                display: flex;
                justify-content: center;
            }
        }

        body {
            margin: 0;
            font-family: monospace;
            font-size: 14px;
            font-weight: bold;
            display: flex;
            justify-content: center;
        }

        .container {
            width: 600px;
            margin-top: 19%;  /* ✅ 30% from top */
        }

        .row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 3%;
        }

        .header {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: right;
        }

        th, td {
            padding: 5px;
        }

        th {
            border-bottom: 1px solid black;
            margin-bottom:20px;
        }

        .total {
            margin-top: 25px;
            text-align: right;
        }
    </style>
</head>

<body>
    <script>
    window.onload = function() {
        window.print();
    };

    window.onafterprint = function() {
        window.close();
    };
</script>

<div class="container">

    <!-- Header -->
    <div class="header">
        <div class="row">
            <div>Receipt No: {{ $data['receipt_no'] }}</div>
            <div> {{ date('d-m-Y', strtotime($data['receipt_date'])) }}</div>
        </div>

        <div>Name: {{ $data['customer_name'] }} | {{ $data['mobile_no'] }}</div>
       
    </div>

    <!-- Items -->
    <table>
        <thead>
            <tr>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($data['items'] as $item)
            <tr>
                <td>{{ \Illuminate\Support\Str::limit($item->pooja_name, 25) }}</td>
                <td>{{ $item->qty }}</td>
                <td>{{ $item->total }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Total -->
    <div class="total">
        Grand Total: {{ $data['grand_total'] }}
    </div>

</div>

</body>
</html>