<?php

namespace App\Http\Controllers\reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB; // Import the DB facade
use Illuminate\Support\Carbon;
use App\Models\ako_stocks;


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

       public function ca_ako_jama_report()
    {
        //
        $data['title'] = 'CA AKKI KAI OIL Jama Report';
        return view('reports.ca_report_ako_jama', compact('data'));
    }
   
       public function ca_ako_karchu_report()
    {
        //
        $data['title'] = 'CA AKKI KAI OIL Karchu Report';
        return view('reports.ca_report_ako_karchu', compact('data'));
    }

    public function ca_report_ako_karchu_ajax(Request $request)
    {
        $resp_data = $request->all();
            $financial_year = $resp_data['financial_year'];
            $resp_data = $this->stock_count($financial_year);
        // 1️⃣ Opening Stock (previous year)
        $opening = DB::table('ako_stocks')
            ->where('financial_year_id', '=', $financial_year)
            ->orderByDesc('financial_year_id')
            ->first();

        // 2️⃣ Purchase grouped by subcategory
        $purchase = DB::table('sales_models as p')
            ->join('purchase_subcategory_models as sc', 'sc.id', '=', 'p.subcategory_id')
            ->where('p.financial_year_id', $financial_year)
            ->select(
                'p.subcategory_id',
                'sc.name as subcategory_name',
                DB::raw("SUM(CASE WHEN p.purcahse_types_id = 1 THEN p.quantity ELSE 0 END) as Akki"),
                DB::raw("SUM(CASE WHEN p.purcahse_types_id = 2 THEN p.quantity ELSE 0 END) as Kai"),
                DB::raw("SUM(CASE WHEN p.purcahse_types_id = 3 THEN p.quantity ELSE 0 END) as Oil")
            )
            ->groupBy('p.subcategory_id', 'sc.name')
            ->get();

        // 3️⃣ Convert to array
        $result = [];

        // 👉 Purchase Data
        foreach ($purchase as $row) {
            $result[] = [
                'subcategory_name' => $row->subcategory_name,
                'Akki' => $row->Akki,
                'Kai'  => $row->Kai,
                'Oil'  => $row->Oil,
            ];
        }
         // 👉 Avialable Stock Row
        $result[] = [
            'subcategory_name' => 'Avialable Stock',
            'Akki' => $opening->akki ?? 0,
            'Kai'  => $opening->kai ?? 0,
            'Oil'  => $opening->oil ?? 0,
        ];

        // 4️⃣ Grand Total
        $grand_total = [
            'Akki' => collect($result)->sum('Akki'),
            'Kai'  => collect($result)->sum('Kai'),
            'Oil'  => collect($result)->sum('Oil'),
        ];

      
         return DataTables::of($result)
        ->addIndexColumn()
        ->with([
            'grand_total' => $grand_total
        ])
        ->make(true);

    }

    public function ca_report_ako_jama_ajax(Request $request)
    {
        $resp_data = $request->all();
            $financial_year = $resp_data['financial_year'];
            $resp_data = $this->stock_count($financial_year);
        // 1️⃣ Opening Stock (previous year)
        $opening = DB::table('ako_stocks')
            ->where('financial_year_id', '<', $financial_year)
            ->orderByDesc('financial_year_id')
            ->first();

        // 2️⃣ Purchase grouped by subcategory
        $purchase = DB::table('purchase_models as p')
            ->join('purchase_subcategory_models as sc', 'sc.id', '=', 'p.subcategory_id')
            ->where('p.financial_year_id', $financial_year)
            ->where('p.is_grocery_selected', 1)
            ->select(
                'p.subcategory_id',
                'sc.name as subcategory_name',
                DB::raw("SUM(CASE WHEN p.purcahse_types_id = 1 THEN p.quantity ELSE 0 END) as Akki"),
                DB::raw("SUM(CASE WHEN p.purcahse_types_id = 2 THEN p.quantity ELSE 0 END) as Kai"),
                DB::raw("SUM(CASE WHEN p.purcahse_types_id = 3 THEN p.quantity ELSE 0 END) as Oil")
            )
            ->groupBy('p.subcategory_id', 'sc.name')
            ->get();

        // 3️⃣ Convert to array
        $result = [];

        // 👉 Opening Stock Row
        $result[] = [
            'subcategory_name' => 'Opening Stock',
            'Akki' => $opening->akki ?? 0,
            'Kai'  => $opening->kai ?? 0,
            'Oil'  => $opening->oil ?? 0,
        ];

        // 👉 Purchase Data
        foreach ($purchase as $row) {
            $result[] = [
                'subcategory_name' => $row->subcategory_name,
                'Akki' => $row->Akki,
                'Kai'  => $row->Kai,
                'Oil'  => $row->Oil,
            ];
        }

        // 4️⃣ Grand Total
        $grand_total = [
            'Akki' => collect($result)->sum('Akki'),
            'Kai'  => collect($result)->sum('Kai'),
            'Oil'  => collect($result)->sum('Oil'),
        ];

      
         return DataTables::of($result)
        ->addIndexColumn()
        ->with([
            'grand_total' => $grand_total
        ])
        ->make(true);

    }
    public function stock_count($financial_year)
    { 
        $previous = "";
        $previous_ako="";
        $prve_akki=0;
        $prev_kai = 0;
        $prev_oil = 0;
        $final_stock = "";
       if($financial_year)
        {
            $previous = DB::table('years')
            ->where('id', '<', $financial_year)
            ->orderBy('id', 'desc')
            ->first();
            if($previous){
                $previous_ako = DB::table('ako_stocks')
                                ->where('financial_year_id', '<', $financial_year)
                                ->limit(1)
                                ->get();
                if($previous_ako)
                    {
                       $prve_akki  = $previous_ako[0]->akki;
                       $prev_kai  = $previous_ako[0]->kai;
                       $prev_oil  = $previous_ako[0]->oil;
                    }
            }
        }
     
        $conditions_purchase = [
                ['financial_year_id', '=', $financial_year],
                ['is_grocery_selected', '=', 1],
            ];
         $conditions_sales = [
                ['financial_year_id', '=', $financial_year],
            ];
            // PURCHASE
        $purchaseTotals = DB::table('purchase_models')
                ->select(
                    DB::raw("SUM(CASE WHEN purcahse_types_id = 1 THEN quantity ELSE 0 END) as Akki_p"),
                    DB::raw("SUM(CASE WHEN purcahse_types_id = 2 THEN quantity ELSE 0 END) as Kai_p"),
                    DB::raw("SUM(CASE WHEN purcahse_types_id = 3 THEN quantity ELSE 0 END) as Oil_p")
                )
                ->where($conditions_purchase)
                ->first();

            // SALES
        $salesTotals = DB::table('sales_models')
                ->select(
                    DB::raw("SUM(CASE WHEN purcahse_types_id = 1 THEN quantity ELSE 0 END) as Akki_s"),
                    DB::raw("SUM(CASE WHEN purcahse_types_id = 2 THEN quantity ELSE 0 END) as Kai_s"),
                    DB::raw("SUM(CASE WHEN purcahse_types_id = 3 THEN quantity ELSE 0 END) as Oil_s")
                )
                ->where($conditions_sales)
                ->first();

            // FINAL STOCK
        $grand = [
                'Akki' => ($purchaseTotals->Akki_p + $prve_akki) - $salesTotals->Akki_s,
                'Kai'  => ($purchaseTotals->Kai_p + $prev_kai) - $salesTotals->Kai_s,
                'Oil'  => ($purchaseTotals->Oil_p + $prev_oil) - $salesTotals->Oil_s,
            ];

            $exists = DB::table('ako_stocks')
            ->where('financial_year_id', $financial_year)
            ->exists();
       if (!$exists) {
            
            $final_stock = DB::table('ako_stocks')->insert([
                    'akki' => $grand['Akki'],
                    'kai' => $grand['Kai'],
                    'oil' => $grand['Oil'],
                    'financial_year_id' => $financial_year,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
                
            }else{

          $final_stock =   DB::table('ako_stocks')->updateOrInsert(
                ['financial_year_id' => $financial_year], // condition
                [
                     'akki' => $grand['Akki'],
                    'kai' => $grand['Kai'],
                    'oil' => $grand['Oil'],
                    'updated_at' => now()
                ]
            );
                
            }
            return ($final_stock);
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
