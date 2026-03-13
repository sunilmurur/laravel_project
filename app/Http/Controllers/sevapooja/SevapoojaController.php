<?php

namespace App\Http\Controllers\sevapooja;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerModel;
use Illuminate\Support\Facades\DB; // Import the DB facade
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class SevapoojaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['title']="Seva Pooja";
        return view('seva_pooja.view_sevapooja', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function search_customer(Request $request)
    {
        $data = $request->all();
        $search_value = $data['search_value'];
        $result = DB::table('customer_models')
        ->select('customer_name','id','mobile_no')
        ->where(function($query) use ($search_value) {
            $query->where('customer_name', 'like', '%' . $search_value . '%')
            ->orWhere('mobile_no', 'like', '%' . $search_value . '%');
        })->limit(10)->get();
        return response()->json($result);
    }
    public function search_on_pooja(Request $request)
    {
        $data = $request->all();
        $search_value = $data['search_value'];
        $result = DB::table('pooja_models')
        ->select('pooja_name','id','code','amount')
        ->where(function($query) use ($search_value) {
            $query->where('pooja_name', 'like', '%' . $search_value . '%');
           // ->orWhere('mobile_no', 'like', '%' . $search_value . '%');
        })->limit(10)->get();
        return response()->json($result);
    }
    
    public function search_on_code(Request $request)
    {
        $resp_data = $request->all();
        $search_value = $resp_data['search_value'];
        $result = DB::table('pooja_models')
        ->select('*')
        ->where('code', '=', $search_value)
        ->get();
        $datas='';
        $datas = new \stdClass;    
        $items='';
        $datas->data = array();
        foreach($result as $r)
        {
            $item = new \stdClass;
            $item->id = $r->id;
            $item->pooja_name = $r->pooja_name;
            $item->code = $r->code;
            $item->amount = $r->amount;
            array_push($datas->data,$item);
        }
        $code =200;
        return response()->json($datas, $code)->header('Content-Type', 'application/json');
    }

    public function submit_pooja_values(Request $request)
        {
            $receipt_id = '';
            $receipt_detail_id = '';
            $last_receipt_no ='';
            $resp_data = $request->all();
            $financial_year_Date = financial_year_check();
            $db_financial_year_Date_id = $financial_year_Date[0];
           /** Retrive Last Recipt No */
            $get_last_insert_detail = DB::table('seva_pooja_receipts')
            ->select('*')
           // ->where('display_year', '=', $db_year_compare)
           ->orderBy('id','desc')
           ->limit(1)
            ->get();
            if($get_last_insert_detail->isNotEmpty())
            {

                $last_receipt_no = $get_last_insert_detail[0]->receipt_no;
                if($db_financial_year_Date_id == $get_last_insert_detail[0]->financial_year_id)
                {
                    $last_receipt_no = $last_receipt_no + 1;
                }
                else
                {
                    $last_receipt_no = '1';
                }

            }
            else
            {
                $last_receipt_no = '1';
            }
           
            $receipt_id = DB::table('seva_pooja_receipts')->insertGetId([
                'receipt_no' => $last_receipt_no,
                'user_id' => $resp_data['user_id'],
                'payment_method_id'=> $resp_data['payment_method'],
                'receipt_date' => $resp_data['current_date'],
                'receipt_time' => $resp_data['current_time'],
                'grand_total'=> $resp_data['over_all_total'],
                'bill_desc'=> $resp_data['bill_desc'],
                'financial_year_id' => $db_financial_year_Date_id,
                'created_at' => now(),
            ]);
            if($receipt_id)
            {
                foreach($resp_data['pooja_details'] as $r)
                {
                    $receipt_detail_id = DB::table('seva_pooja_receipt_details')->insertGetId([
                        'seva_pooja_receipt_id' => $receipt_id,
                        'pooja_id'=> $r['pooja_id'],
                        'pooja_code'=>$r['code'],
                        'pooja_name' => $r['pooja_name'],
                        'qty' => $r['qty'],
                        'price'=> $r['price'],
                        'total'=> $r['total'],
                        'created_at' => now(),
                    ]);

                }
            }
            if($receipt_detail_id)
            {
                $print_data= '';
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
                    ->where('r.id', $receipt_id)
                    ->first();
                if($receipt){
                       $receipt_items = DB::table('seva_pooja_receipt_details')
                        ->where('seva_pooja_receipt_id', $receipt_id)
                        ->get();
                $print_data = [
                        'id' => $receipt->id,
                        'receipt_no' => $receipt->receipt_no,
                        'user_id' => $receipt->user_id,
                        'customer_name' => $receipt->customer_name,
                        'mobile_no' => $receipt->mobile_no,
                        'address' => $receipt->address,
                        'payment_method_id' => $receipt->payment_method,
                        'receipt_date' => $receipt->receipt_date,
                        'receipt_time' => $receipt->receipt_time,
                        'grand_total' => $receipt->grand_total,
                        'bill_desc' => $receipt->bill_desc,
                        'created_at' => $receipt->created_at,
                        'items' => $receipt_items   
                    ];
                }
                $this->printReceipt($print_data);
                $code =200;
                $json_data = array
                (
                    'status'=>'Pooja Added Successfully',
                    'code' =>$code,
                    'data' => $print_data
                );
                return response()->json($json_data, $code)->header('Content-Type', 'application/json');
            }
            else
            {
                $code =400;
                $json_data = array
                (
                    'status'=>'Success',
                    'code' =>$code,
                );
                return response()->json($json_data, $code)->header('Content-Type', 'application/json');
            }
        
         
        }
    
        public function seva_pooja_report()
        {
            //
            $data['title']="Seva Pooja Report";
            return view('seva_pooja.seva_pooja_report', compact('data'));
        }

        public function seva_pooja_report_ajax(Request $request)
        {
            $resp_data = $request->all();

            $from_date = $resp_data['from_date'];
            $to_date = $resp_data['to_date'];
            $financial_year = $resp_data['financial_year'];
            $payment_type = $resp_data['payment_type'];

            $conditions = [
                ['seva_pooja_receipts.receipt_date', '>=', $from_date],
                ['seva_pooja_receipts.receipt_date', '<=', $to_date],
                ['seva_pooja_receipts.financial_year_id', '=', $financial_year],
            ];

            if($payment_type != 0)
            {
                $conditions[] = ['seva_pooja_receipts.payment_method_id', '=', $payment_type];
            }

             /** Ajax Function call for table  */
        $seva_pooja = DB::table('seva_pooja_receipts')
        ->join('customer_models', 'customer_models.id', '=', 'seva_pooja_receipts.user_id') // Join shares table with users table
        ->join('payment_types', 'payment_types.id', '=', 'seva_pooja_receipts.payment_method_id') // Join users table with follows table
        ->join('years', 'years.id', '=', 'seva_pooja_receipts.financial_year_id') // Join users table with follows table
        ->where($conditions)
        ->select('seva_pooja_receipts.*', 'customer_models.customer_name as customer_name','customer_models.mobile_no as mobile_no','years.display_year as display_year','payment_types.payment_type as payment_type') // Select all columns from shares table and the name column from users table
        ->get(); // Execute the query and get the results
       
        return DataTables::of($seva_pooja)->make(true); // Pass to Data table
        
        }



    // =========================
    // Actual print function
    // =========================
    public function printReceipt($print_data)
    {
        try {
            // Change computer name & shared printer name
            $connector = new WindowsPrintConnector("smb://DESKTOP-ABC123/EPSON");
            $printer = new Printer($connector);

            $width = 48; // 80mm Epson

            /* ================= HEADER ================= */
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->setEmphasis(true);
            $printer->text("TEMPLE RECEIPT\n");
            $printer->setEmphasis(false);
            $printer->text("Thank You Visit Again\n");
            $printer->text(str_repeat("-", $width) . "\n");

            /* ================= RECEIPT INFO ================= */
            $printer->setJustification(Printer::JUSTIFY_LEFT);
            $printer->text("Receipt No : " . $print_data['receipt_no'] . "\n");
            $printer->text("Date       : " . $print_data['receipt_date'] . "\n");
            $printer->text("Time       : " . $print_data['receipt_time'] . "\n");
            $printer->text("Customer   : " . $print_data['customer_name'] . "\n");
            $printer->text("Mobile     : " . $print_data['mobile_no'] . "\n");

            if (!empty($print_data['address'])) {
                $printer->text("Address    : " . $print_data['address'] . "\n");
            }

            $printer->text(str_repeat("-", $width) . "\n");

            /* ================= ITEM HEADER ================= */
            $printer->text(
                str_pad("Item", 24) .
                str_pad("Qty", 6) .
                str_pad("Amt", 18, " ", STR_PAD_LEFT) . "\n"
            );
            $printer->text(str_repeat("-", $width) . "\n");

            /* ================= ITEMS ================= */
            $subtotal = 0;
            foreach ($print_data['items'] as $item) {
                $name = substr($item->pooja_name, 0, 24); // limit name
                $qty = $item->qty;
                $total = $item->total;

                $subtotal += $total;

                $printer->text(
                    str_pad($name, 24) .
                    str_pad($qty, 6) .
                    str_pad(number_format($total, 2), 18, " ", STR_PAD_LEFT) . "\n"
                );
            }

            $printer->text(str_repeat("-", $width) . "\n");

            /* ================= GRAND TOTAL ================= */
            $printer->setEmphasis(true);
            $printer->text(
                str_pad("GRAND TOTAL", 30) .
                str_pad(number_format($print_data['grand_total'], 2), 18, " ", STR_PAD_LEFT) . "\n"
            );
            $printer->setEmphasis(false);
            $printer->text(str_repeat("-", $width) . "\n");

            /* ================= PAYMENT ================= */
            $printer->text("Payment Mode : " . $print_data['payment_method_id'] . "\n");

            if (!empty($print_data['bill_desc'])) {
                $printer->text("Note : " . $print_data['bill_desc'] . "\n");
            }

            $printer->feed(3);

            /* ================= CUT ================= */
            $printer->cut(Printer::CUT_FULL);
            $printer->close();

            return "Printed Successfully";

        } catch (\Exception $e) {
            return "Print Error: " . $e->getMessage();
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
