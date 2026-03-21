<?php

namespace App\Http\Controllers\purchase;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Purchase_model;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB; // Import the DB facade
use Illuminate\Support\Carbon;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['title']="Purchase";
        return view('purchase.view_purchase', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data['title'] = 'Add Purchase';
        return view('purchase.add_purchase', compact('data'));
    }
    public function get_all_purchase()
    {
        /** Ajax Function call for table  */
        $purchase = Purchase_model::all();  // Retirve Query
        return DataTables::of($purchase)->make(true); // Pass to Data table
    }
    public function purchase_report_ajax(Request $request)
    {
         $resp_data = $request->all();
        $from_date = $resp_data['from_date'];
        $to_date = $resp_data['to_date'];
        $financial_year = $resp_data['financial_year'];
        $category = $resp_data['category'];
        $subcategory = $resp_data['subcategory'];
        $conditions = [
                ['purchase_models.date', '>=', $from_date],
                ['purchase_models.date', '<=', $to_date],
                ['purchase_models.financial_year_id', '=', $financial_year],
                 ['purchase_models.is_donation_selected', '=', 0],
            ];
        if($category != 0)
        {
                $conditions[] = ['purchase_models.category_id', '=', $category];
        }
        if($subcategory != 0)
        {
                $conditions[] = ['purchase_models.subcategory_id', '=', $subcategory];
        }

        $purchase_details = DB::table('purchase_models')
        ->join('purchase_category_models', 'purchase_category_models.id', '=', 'purchase_models.category_id')
        ->join('purchase_subcategory_models', 'purchase_subcategory_models.id', '=', 'purchase_models.subcategory_id')
        ->join('years', 'years.id', '=', 'purchase_models.financial_year_id')
        ->leftJoin('purcahse_types', 'purcahse_types.id', '=', 'purchase_models.purcahse_types_id')
        ->where($conditions)
        ->select(
        'purchase_models.*',
        'purchase_category_models.name as category_name',
        'purchase_subcategory_models.name as subcategory_name',
        'years.display_year as display_year',

        DB::raw("CASE WHEN purcahse_types.type='Akki' THEN purchase_models.quantity ELSE 0 END as Akki"),
        DB::raw("CASE WHEN purcahse_types.type='Kai' THEN purchase_models.quantity ELSE 0 END as Kai"),
        DB::raw("CASE WHEN purcahse_types.type='Oil' THEN purchase_models.quantity ELSE 0 END as Oil")
        )
        ->get();    
         return DataTables::of($purchase_details)->make(true); // Pass to Data table    
        
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
        //
        $resp_data = $request->all();
    
        $validatedData = $request->validate([
           'amount' => 'required|int|min:0',
            'category' => 'required',
            'subcategory' => 'required',
            'date' => 'required',
            'detail' => 'required',
        ], [
            'amount.required' => 'The name field is required.',
            'subcategory.required' => 'The field is required.',
            'category.required' => 'The field is required.',
            'date.required' => 'The field is required.',
            'date.required' => 'The field is required.',
            'detail.required' => 'The field is required.',
        ]);
    
        $financial_year_Date = financial_year_check();
        $db_financial_year_Date_id = $financial_year_Date[0];
        $cat = new Purchase_model();
   
        $cat->category_id = $validatedData['category'];
        $cat->subcategory_id = $validatedData['subcategory'];
        $cat->amount = $validatedData['amount'];
        $cat->date = $validatedData['date'];
        $cat->detail = $validatedData['detail'];
        $cat->quantity = $request->quantity; // optional field
        $cat->purcahse_types_id = $request->type; // optional field
        $cat->financial_year_id = $db_financial_year_Date_id; 
        $cat->is_donation_selected = 0;
        
        if($request->type)
        {
                $cat->is_grocery_selected = 1;
        }else
        {
           $cat->is_grocery_selected = 0; 
        }
        if ($cat->save()) {
            return redirect()->route('Purchase.index')->with('success', 'Purchase Data saved Successfully');
        } else {
            // Data not saved
            // Redirect back with error message
            return redirect()->back()->withInput()->with('error', 'Failed to save data');
        }
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
        $data['title']="Edit Purchase";
        $edit_purchase = Purchase_model::find($id);
        return view('purchase.edit_purchase', compact('data','edit_purchase'));
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
        $cat= Purchase_model::find($id);
        $validatedData = $request->validate([
           'amount' => 'required|int|min:0',
            'category' => 'required',
            'subcategory' => 'required',
            'date' => 'required',
            'detail' => 'required',
        ], [
            'amount.required' => 'The name field is required.',
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
        $cat->amount = $validatedData['amount'];
        $cat->date = $validatedData['date'];
        $cat->detail = $validatedData['detail'];
        $cat->quantity = $request->quantity; // optional field
        $cat->purcahse_types_id = $request->type; // optional field
        $cat->financial_year_id = $db_financial_year_Date_id; 
        
        if($request->type)
        {
                $cat->is_grocery_selected = 1;
        }else
        {
           $cat->is_grocery_selected = 0; 
        }
        if ($cat->save()) {
            return redirect()->route('Purchase.index')->with('success', 'Purchase Data saved Successfully');
        } else {
            // Data not saved
            // Redirect back with error message
            return redirect()->back()->withInput()->with('error', 'Failed to save data');
        }
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
