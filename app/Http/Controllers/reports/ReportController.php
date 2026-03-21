<?php

namespace App\Http\Controllers\reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB; // Import the DB facade
use Illuminate\Support\Carbon;

class ReportController extends Controller
{
    //
     public function ca_sales_report()
    {
        //
        $data['title'] = 'CA Report Sales';
        return view('reports.ca_report_sales', compact('data'));
    }

      public function ca_purchase_report()
    {
        //
        $data['title'] = 'CA Report Purchase';
        return view('reports.ca_report_purchase', compact('data'));
    }
        public function ca_report_purchase_ajax(Request $request)
    {
         $resp_data = $request->all();
        $from_date = $resp_data['from_date'];
        $to_date = $resp_data['to_date'];
        $financial_year = $resp_data['financial_year'];
        $category = $resp_data['category'];
        $subcategory = $resp_data['subcategory'];
        $conditions = [
                ['p.date', '>=', $from_date],
                ['p.date', '<=', $to_date],
                ['p.financial_year_id', '=', $financial_year],
            ];
        if($category != 0)
        {
                $conditions[] = ['p.category_id', '=', $category];
        }
        if($subcategory != 0)
        {
                $conditions[] = ['p.subcategory_id', '=', $subcategory];
        }

        // ✅ Subcategory-wise total
    $purchase_details = DB::table('purchase_models as p')
        ->join('purchase_subcategory_models as sc', 'sc.id', '=', 'p.subcategory_id')
        ->where($conditions)
        ->where('p.amount', '>', 0) // ✅ REMOVE ZERO AMOUNT
        ->select(
            'sc.name as subcategory_name',
            DB::raw('SUM(p.amount) as total_amount')
        )
        ->groupBy('p.subcategory_id', 'sc.name')
        ->orderBy('sc.name')
        ->get();

    // ✅ Grand total
    $grand_total = DB::table('purchase_models as p')
        ->where($conditions)
        ->sum('p.amount');

    return DataTables::of($purchase_details)
        ->addIndexColumn()
        ->with([
            'grand_total' => $grand_total
        ])
        ->make(true);

    }

    public function ca_report_sales_ajax(Request $request)
    {
        
        $resp_data = $request->all();
        $from_date = $resp_data['from_date'];
        $to_date = $resp_data['to_date'];
        $financial_year = $resp_data['financial_year'];
        $category = $resp_data['category'];
        $subcategory = $resp_data['subcategory'];
        $conditions = [
                ['s.receipt_date', '>=', $from_date],
                ['s.receipt_date', '<=', $to_date],
                ['s.financial_year_id', '=', $financial_year],
            ];
        if($category != 0)
        {
                $conditions[] = ['s.category_id', '=', $category];
        }
        if($subcategory != 0)
        {
                $conditions[] = ['s.subcategory_id', '=', $subcategory];
        }

     $sales_details = DB::table('seva_pooja_receipt_details as s')
    ->join('subcategory_models as sc', 'sc.id', '=', 's.subcategory_id')
    ->where($conditions)
    ->select(
        'sc.name as subcategory_name',
        DB::raw('SUM(s.total) as total_amount')
    )
    ->groupBy('sc.name')
    ->orderBy('sc.name')
    ->get();

    $grand_total = DB::table('seva_pooja_receipt_details as s')
    ->where($conditions)
    ->sum('s.total');

return DataTables::of($sales_details)
    ->addIndexColumn() // auto index
    ->with([
        'grand_total' => $grand_total
    ])
    ->make(true);
        }
}
