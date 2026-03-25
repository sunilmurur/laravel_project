<?php

namespace App\Http\Controllers\master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerModel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB; // Import the DB facade
use Illuminate\Validation\Rule;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['title']="View Customer";
        return view('master.customer.view_customer', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data['title'] = 'Add Customer';
        return view('master.customer.add_customer', compact('data'));
    }

    public function get_all_customer()
    {
        /** Ajax Function call for table  */
       // $customer = CustomerModel::all();  // Retirve Query
       // return DataTables::of($customer)->make(true); // Pass to Data table

        $customer = DB::table('customer_models')
            ->join('valaya_models', 'customer_models.valaya_id', '=', 'valaya_models.id')
            ->select(
                'customer_models.id',
                'customer_models.valaya_id',
                'customer_models.customer_name',
                'customer_models.address',
                'customer_models.mobile_no',
                'valaya_models.name as valaya_name'
            )
            ->get(); // Execute the query and get the results

return DataTables::of($customer)->make(true);
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
      
        $validatedData = $request->validate([
            'customer_name' => 'required|string',
            'mobile_no' => 'required|digits:10|unique:customer_models,mobile_no',
            'address' => 'required',
            'valaya' => 'required',
        ], [
            'customer_name.required' => 'The Customer Name field is required.',
            'mobile_no.required' => 'The Mobile No field is required.',
            'mobile_no.unique' => 'The Mobile No has already been taken.',
            'address.required' => 'The Address field is required.',
            'valaya.required' => 'This field is required.',
        ]);
        $cat = new CustomerModel();
        $cat->customer_name = $validatedData['customer_name'];
        $cat->mobile_no = $validatedData['mobile_no'];
        $cat->address = $validatedData['address'];
        $cat->valaya_id = $validatedData['valaya'];
        $cat->print_required = $request->has('print_required') ? 1 : 0;
        
       
        if ($cat->save()) {
            return redirect()->route('Customer.index')->with('success', 'Customer Data saved Successfully');
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
        $data['title']="Edit Customer";
        $edit_customer = CustomerModel::find($id);
        return view('master.customer.edit_customer', compact('edit_customer','data'));
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
        $cat= CustomerModel::find($id);
        $validatedData = $request->validate([
            'customer_name' => 'required|string',
            'mobile_no' => [
                'required',
                'string',
                Rule::unique('customer_models', 'mobile_no')->ignore($cat->id),
            ],
            'address' => 'required',
            'valaya' => 'required',
        ], [
            'customer_name.required' => 'The Customer Name field is required.',
            'mobile_no.required' => 'The Mobile No field is required.',
            'mobile_no.unique' => 'The Mobile No has already been taken.',
            'address.required' => 'The Address field is required.',
            'valaya.required' => 'This field is required.',
        ]);
        //$cat = new CustomerModel();
        $cat->customer_name = $validatedData['customer_name'];
        $cat->mobile_no = $validatedData['mobile_no'];
        $cat->address = $validatedData['address'];
        $cat->valaya_id = $validatedData['valaya'];
        $cat->print_required = $request->has('print_required') ? 1 : 0;

       
        if ($cat->save()) {
            return redirect()->route('Customer.index')->with('success', 'Customer Data Updated Successfully');
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
