<?php

namespace App\Http\Controllers\donation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Purchase_model;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB; // Import the DB facade
use Illuminate\Support\Carbon;

class DonationController extends Controller
{
    //
    public function index()
    {
        //
        $data['title']="Donation";
        return view('donation.view_donation', compact('data'));
    }
    public function create()
    {
        //
        $data['title'] = 'Add Donation';
        return view('donation.add_donation', compact('data'));
    }

    public function store(Request $request)
    {
        //
        //
        $resp_data = $request->all();
     
        $validatedData = $request->validate([
            'category' => 'required',
            'subcategory' => 'required',
            'date' => 'required',
            'detail' => 'required',
            'customer_name'=>'required',

        ], [
            'subcategory.required' => 'The field is required.',
            'category.required' => 'The field is required.',
            'date.required' => 'The field is required.',
            'date.required' => 'The field is required.',
            'detail.required' => 'The field is required.',
            'customer_name.required' => 'The field is required.',
        ]);
    
        $financial_year_Date = financial_year_check();
        $db_financial_year_Date_id = $financial_year_Date[0];
        $cat = new Purchase_model();
   
        $cat->category_id = $validatedData['category'];
        $cat->subcategory_id = $validatedData['subcategory'];
        $cat->amount = 0;
        $cat->date = $validatedData['date'];
        $cat->detail = $validatedData['detail'];
        $cat->quantity = $request->quantity; 
        $cat->purcahse_types_id = $request->type; 
        $cat->financial_year_id = $db_financial_year_Date_id; 
        $cat->customer_id = $request->customer_id;
        $cat->is_donation_selected = 1;
        
        if($request->type)
        {
                $cat->is_grocery_selected = 1;
        }else
        {
           $cat->is_grocery_selected = 0; 
        }
        if ($cat->save()) {
            return redirect()->route('Donation.index')->with('success', 'Donation Data saved Successfully');
        } else {
            // Data not saved
            // Redirect back with error message
            return redirect()->back()->withInput()->with('error', 'Failed to save data');
        }
    }

     public function donation_report_ajax(Request $request)
    {
        $resp_data = $request->all();
        $from_date = $resp_data['from_date'];
        $to_date = $resp_data['to_date'];
        $financial_year = $resp_data['financial_year'];
        $category = $resp_data['category'];
       
        $conditions = [
                ['purchase_models.date', '>=', $from_date],
                ['purchase_models.date', '<=', $to_date],
                ['purchase_models.financial_year_id', '=', $financial_year],
                ['purchase_models.is_donation_selected', '=', 1],
            ];
        if($category != 0)
        {
                $conditions[] = ['purchase_models.category_id', '=', $category];
        }

        $donation_details = DB::table('purchase_models')
        ->join('purchase_category_models', 'purchase_category_models.id', '=', 'purchase_models.category_id')
        ->join('purchase_subcategory_models', 'purchase_subcategory_models.id', '=', 'purchase_models.subcategory_id')
        ->join('years', 'years.id', '=', 'purchase_models.financial_year_id')
        ->join('customer_models', 'customer_models.id', '=', 'purchase_models.customer_id')
        ->leftJoin('purcahse_types', 'purcahse_types.id', '=', 'purchase_models.purcahse_types_id')
        ->where($conditions)
        ->select(
        'purchase_models.*',
        'purchase_category_models.name as category_name',
        'purchase_subcategory_models.name as subcategory_name',
        'years.display_year as display_year',
        'customer_models.customer_name as customer_name',

        DB::raw("CASE WHEN purcahse_types.type='Akki' THEN purchase_models.quantity ELSE 0 END as Akki"),
        DB::raw("CASE WHEN purcahse_types.type='Kai' THEN purchase_models.quantity ELSE 0 END as Kai"),
        DB::raw("CASE WHEN purcahse_types.type='Oil' THEN purchase_models.quantity ELSE 0 END as Oil")
        )
        ->get();    
         return DataTables::of($donation_details)->make(true); // Pass to Data table    
        
    }
    public function edit($id)
    {
        $data['title']="Edit Donation";
        $edit_donation = Purchase_model::find($id);
        return view('donation.edit_donation', compact('data','edit_donation'));
    }

     public function update(Request $request, $id)
    {
        $cat= Purchase_model::find($id);
        $validatedData = $request->validate([
            'category' => 'required',
            'subcategory' => 'required',
            'date' => 'required',
            'detail' => 'required',
            'customer_name'=>'required',
        ], [
            'subcategory.required' => 'The field is required.',
            'category.required' => 'The field is required.',
            'date.required' => 'The field is required.',
            'date.required' => 'The field is required.',
            'detail.required' => 'The field is required.',
            'customer_name.required' => 'The field is required.',
        ]);
    
        $financial_year_Date = financial_year_check();
        $db_financial_year_Date_id = $financial_year_Date[0];
   
        $cat->category_id = $validatedData['category'];
        $cat->subcategory_id = $validatedData['subcategory'];
        $cat->date = $validatedData['date'];
        $cat->detail = $validatedData['detail'];
        $cat->quantity = $request->quantity; 
        $cat->purcahse_types_id = $request->type; 
        $cat->financial_year_id = $db_financial_year_Date_id; 
        $cat->customer_id = $request->customer_id;
        
        if($request->type)
        {
                $cat->is_grocery_selected = 1;
        }else
        {
           $cat->is_grocery_selected = 0; 
        }
        if ($cat->save()) {
            return redirect()->route('Donation.index')->with('success', 'Donation Data saved Successfully');
        } else {
            // Data not saved
            // Redirect back with error message
            return redirect()->back()->withInput()->with('error', 'Failed to save data');
        }
    }

}
