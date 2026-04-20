<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrintController extends Controller
{
    public function printReceipt($id)
    {
        $receipt = DB::table('seva_pooja_receipts as r')
            ->leftJoin('customer_models as c', 'c.id', '=', 'r.user_id')
            ->leftJoin('payment_types as p', 'p.id', '=', 'r.payment_method_id')
            ->select(
                'r.*',
                'c.customer_name',
                'c.mobile_no',
                'c.address',
                'p.payment_type as payment_method'
            )
            ->where('r.id', $id)
            ->first();

        if (!$receipt) {
            return "Receipt not found";
        }

        $receipt_items = DB::table('seva_pooja_receipt_details')
            ->where('seva_pooja_receipt_id', $id)
            ->get();

        $print_data = [
            'receipt_no' => $receipt->receipt_no,
            'customer_name' => $receipt->customer_name,
            'mobile_no' => $receipt->mobile_no,
            'address' => $receipt->address,
            'receipt_date' => $receipt->receipt_date,
            'grand_total' => $receipt->grand_total,
            'items' => $receipt_items
        ];
        //print_r($print_data);
        //exit;

        return view('print.print', ['data' => $print_data]);
    }
}
