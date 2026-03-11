<?php

namespace App\Http\Controllers\purchase;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Purchase_model;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\Rule;

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
        $validatedData = $request->validate([
           'amount' => 'required|int|min:1',
            'purchase_detail' => 'required',
            'category' => 'required',
            'subcategory' => 'required',
            'date' => 'required',
        ], [
            'amount.required' => 'The name field is required.',
            'purchase_detail.required' => 'The field is required.',
            'subcategory.required' => 'The field is required.',
            'category.required' => 'The field is required.',
            'purchase_detail.required' => 'The field is required.',  
        ]);

        $cat = new Purchase_model();
        $cat->category_id = $validatedData['category'];
        $cat->subcategory_id = $validatedData['subcategory'];
        $cat->detail = $validatedData['purchase_detail'];
        $cat->amount = $validatedData['amount'];
        $cat->date = $validatedData['date'];
        $cat->type = '1';
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
