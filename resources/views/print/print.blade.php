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
            }
        }

        body {
            font-family: monospace;
            font-size: 13px;
            display: flex;
            justify-content: center;
        }

        .receipt {
            width: 650px;
            border: 2px solid black;
            padding: 2px;
            margin-top: 20px;
            border-radius: 5px;   /* ✅ outer radius */
        }
        .inner-box {
    border: 1px solid black;   /* inner border */
    padding: 10px;
    border-radius: 5px;   /* ✅ outer radius */
}

       .header {
    border-bottom: 1px solid black;
    padding-bottom: 5px;
    margin-bottom: 5px;
}

.header-inner {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.title {
    flex: 1;
    text-align: center;
}

.main-title {
    
    font-size: 9px;
}

.sub-line1 {
    font-weight: bold;
    font-size: 12px;
    margin-top: 2px;
}
.sub-line2 {

    font-size: 10px;
    margin-top: 2px;
}

.logo img {
    width: 60px;   /* adjust size */
    height: 60px;
    object-fit: contain;
}

.left {
    text-align: left;
}

.right {
    text-align: right;
}

        .row {
            display: flex;
            justify-content: space-between;
            margin: 5px 0;
        }

        .section {
            border-bottom: 1px solid black;
            padding: 5px 0;
        }

        .label {
            width: 150px;
            display: inline-block;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid black;
            padding: 5px;
            text-align: center;
        }

        .total {
            text-align: right;
            margin-top: 10px;
            font-weight: bold;
        }

        .footer {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
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

<div class="receipt">

    <div class="inner-box">
    <!-- Header -->
<div class="header">
    <div class="header-inner">

        <!-- Left Image -->
        <div class="logo left">
            <img src="{{ asset('images/left-logo.png') }}" alt="Left Logo">
        </div>

        <!-- Title -->
        <div class="title">
             <div class="main-title">|| ಓಂ ಹ್ರೀಂ  ಮಹಾಲಕ್ಷ್ಮೈ ನಮಃ ||</div>
    <div class="sub-line1">ಶ್ರೀ ಆದಿಶಕ್ತಿ ಮಹಾಲಕ್ಷ್ಮೀ ದೇವಸ್ಥಾನ ಲಕ್ಷ್ಮೀಪುರ</div>
    <div class="sub-line2">ಹಿರ್ಗಾನ ಗ್ರಾಮ ಮತ್ತು ಅಂಚೆ, ಕಾರ್ಕಳ ತಾಲೂಕು</div>
        </div>
            
        <!-- Right Image -->
        <div class="logo right">
            <img src="{{ asset('images/right-logo.png') }}" alt="Right Logo">
        </div>

    </div>
</div>

    <!-- Receipt Info -->
    <div class="section">
        <div class="row">
            <div><span class="label">Receipt No:</span> {{ $data['receipt_no'] }}</div>
            <div><span class="label">Date:</span> {{ date('d-m-Y', strtotime($data['receipt_date'])) }}</div>
        </div>

        <div class="row">
            <div><span class="label">Name:</span> {{ $data['customer_name'] }}</div>
            <div><span class="label">Mobile:</span> {{ $data['mobile_no'] }}</div>
        </div>
    </div>

    <!-- Items Table -->
    <table>
        <thead>
            <tr>
                <th>SL No</th>
                <th>Seva Name</th>
                <th>Qty</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data['items'] as $index => $item)
            <tr>
                 <td>{{ $index + 1 }}</td>
                <td>{{ \Illuminate\Support\Str::limit($item->pooja_name, 25) }}</td>
                <td>{{ $item->qty }}</td>
                <td>{{ $item->total }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Total -->
    <div class="total">
        Grand Total: ₹ {{ $data['grand_total'] }}
    </div>

    <!-- Footer -->
    <div class="footer">
        <div>Signature .................</div>
        <div>Authorized</div>
    </div>
</div>
</div>

</body>
</html>