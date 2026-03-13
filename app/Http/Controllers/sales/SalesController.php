<?php

namespace App\Http\Controllers\sales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SalesModel;
use Illuminate\Support\Facades\DB; // Import the DB facade
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;

class SalesController extends Controller
{
      public function index()
    {
        //
        $data['title']="Sales";
        return view('sales.view_sales', compact('data'));
    }

    public function sales_report_ajax(Request $request)
    {
         $resp_data = $request->all();
        $from_date = $resp_data['from_date'];
        $to_date = $resp_data['to_date'];
        $financial_year = $resp_data['financial_year'];
        $category = $resp_data['category'];
        $subcategory = $resp_data['subcategory'];
        $conditions = [
                ['sales_models.date', '>=', $from_date],
                ['sales_models.date', '<=', $to_date],
                ['sales_models.financial_year_id', '=', $financial_year],
            ];
        if($category != 0)
        {
                $conditions[] = ['sales_models.category_id', '=', $category];
        }
        if($subcategory != 0)
        {
                $conditions[] = ['sales_models.subcategory_id', '=', $subcategory];
        }

        $sales_details = DB::table('sales_models')
        ->join('purchase_category_models', 'purchase_category_models.id', '=', 'sales_models.category_id')
        ->join('purchase_subcategory_models', 'purchase_subcategory_models.id', '=', 'sales_models.subcategory_id')
        ->join('years', 'years.id', '=', 'sales_models.financial_year_id')
        ->leftJoin('purcahse_types', 'purcahse_types.id', '=', 'sales_models.purcahse_types_id')
        ->where($conditions)
        ->select(
        'sales_models.*',
        'purchase_category_models.name as category_name',
        'purchase_subcategory_models.name as subcategory_name',
        'years.display_year as display_year',

        DB::raw("CASE WHEN purcahse_types.type='Akki' THEN sales_models.quantity ELSE 0 END as Akki"),
        DB::raw("CASE WHEN purcahse_types.type='Kai' THEN sales_models.quantity ELSE 0 END as Kai"),
        DB::raw("CASE WHEN purcahse_types.type='Oil' THEN sales_models.quantity ELSE 0 END as Oil")
        )
        ->get();    
         return DataTables::of($sales_details)->make(true); // Pass to Data table    
        
    }
    public function create()
    {
        $data['title'] = 'Add Sales';
        return view('sales.add_sales', compact('data'));
    }


    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'category' => 'required',
            'subcategory' => 'required',
            'date' => 'required',
            'detail' => 'required',
            'type'=> 'required'
        ]);

        $financial_year_Date = financial_year_check();
        $financial_year_id = $financial_year_Date[0];

        $sale = new SalesModel();

        $sale->category_id = $validatedData['category'];
        $sale->subcategory_id = $validatedData['subcategory'];
        $sale->date = $validatedData['date'];
        $sale->detail = $validatedData['detail'];
        $sale->quantity = $request->quantity;
        $sale->purcahse_types_id = $request->type;
        $sale->financial_year_id = $financial_year_id;

        if($sale->save())
        {
            return redirect()->route('Sales.index')
            ->with('success','Sales Data Saved Successfully');
            
        }

        return redirect()->back()
        ->withInput()
        ->with('error','Failed to Save Data');

    }

      public function edit($id)
    {
        $data['title']="Edit Sales";
        $edit_sales = SalesModel::find($id);
        return view('sales.edit_sales', compact('data','edit_sales'));
    }
     public function update(Request $request, $id)
    {
        $cat= SalesModel::find($id);
        $validatedData = $request->validate([
            'category' => 'required',
            'subcategory' => 'required',
            'date' => 'required',
            'detail' => 'required',


        ], [
            'subcategory.required' => 'The field is required.',
            'category.required' => 'The field is required.',
            'date.required' => 'The field is required.',
            'date.required' => 'The field is required.',
            'detail.required' => 'The field is required.',
        ]);
    
        $financial_year_Date = financial_year_check();
        $db_financial_year_Date_id = $financial_year_Date[0];
   
        $cat->category_id = $validatedData['category'];
        $cat->subcategory_id = $validatedData['subcategory'];
        $cat->date = $validatedData['date'];
        $cat->detail = $validatedData['detail'];
        $cat->quantity = $request->quantity; // optional field
        $cat->purcahse_types_id = $request->type; // optional field
        $cat->financial_year_id = $db_financial_year_Date_id; 
        
        if ($cat->save()) {
            return redirect()->route('Sales.index')->with('success', 'Sales Data Updated Successfully');
        } else {
            // Data not saved
            // Redirect back with error message
            return redirect()->back()->withInput()->with('error', 'Failed to save data');
        }
    }

}