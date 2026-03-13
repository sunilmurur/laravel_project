<?php

namespace App\Http\Controllers\master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PoojaModel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB; // Import the DB facade
use Illuminate\Validation\Rule;

class PoojaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['title']="View Pooja";
        return view('master.pooja.view_pooja', compact('data'));
    }
    public function get_all_pooja()
    {
        /** Ajax Function call for table  */
        $pooja = DB::table('pooja_models')
        ->join('category_models', 'category_models.id', '=', 'pooja_models.category_id') // Join shares table with users table
        ->join('subcategory_models', 'subcategory_models.id', '=', 'pooja_models.subcategory_id') // Join users table with follows table
        ->select('pooja_models.*', 'category_models.name as category_name','subcategory_models.name as subcategory_name') // Select all columns from shares table and the name column from users table
        ->get(); // Execute the query and get the results
        
        return DataTables::of($pooja)->make(true); // Pass to Data table
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data['title'] = 'Add Pooja';
        return view('master.pooja.add_pooja', compact('data'));
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
            'pooja_name' => 'required|string',
            'amount' => 'required|int|min:1',
            'description' => 'required|string',
            'subcategory' => 'required',
            'category' => 'required',
            'code' => 'required|string|unique:pooja_models,code',
        ], [
            'pooja_name.required' => 'The Pooja name field is required.',
            'pooja_name.string' => 'The Pooja name field must be a string.',
            'amount.required' => 'The amount field is required.',
            'amount.string' => 'The amount field must be a string.',
            'amount.min' => 'The amount field must be at least 6 characters.',
            'description.required' => 'The Pooja name field is required.',
            'description.string' => 'The Pooja name field must be a string.',
            'subcategory.required' => 'This field is required.',
            'category.required' => 'This field is required.',
            'code.unique' => 'The Code has already been taken.',
        ]);

        $cat = new PoojaModel();
        $cat->pooja_name = $validatedData['pooja_name'];
        $cat->pooja_description = $validatedData['description'];
        $cat->amount = $validatedData['amount'];
        $cat->category_id = $validatedData['category'];
        $cat->subcategory_id = $validatedData['subcategory'];   
        $cat->code = $validatedData['code'];   

        if ($cat->save()) {
            return redirect()->route('Pooja.index')->with('success', 'Pooja Data saved Successfully');
      
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
        $data['title']="Edit Pooja";
        $edit_pooja = PoojaModel::find($id);
        return view('master.pooja.edit_pooja', compact('edit_pooja','data'));
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
        $cat= PoojaModel::find($id);
        $validatedData = $request->validate([
            'pooja_name' => 'required|string',
            'amount' => 'required|int|min:1',
            'description' => 'required|string',
            'subcategory' => 'required',
            'category' => 'required',
            'code' => [
                'required',
                'string',
                Rule::unique('pooja_models', 'code')->ignore($cat->id),
            ],
        ], [
            'pooja_name.required' => 'The Pooja name field is required.',
            'pooja_name.string' => 'The Pooja name field must be a string.',
            'amount.required' => 'The amount field is required.',
            'amount.string' => 'The amount field must be a string.',
            'amount.min' => 'The amount field must be at least 6 characters.',
            'description.required' => 'The Pooja name field is required.',
            'description.string' => 'The Pooja name field must be a string.',
            'subcategory.required' => 'This field is required.',
            'category.required' => 'This field is required.',
            'code.unique' => 'The Code has already been taken.',
        ]);

        $cat->pooja_name = $validatedData['pooja_name'];
        $cat->pooja_description = $validatedData['description'];
        $cat->amount = $validatedData['amount'];
        $cat->category_id = $validatedData['category'];
        $cat->subcategory_id = $validatedData['subcategory'];   

        if ($cat->save()) {
            return redirect()->route('Pooja.index')->with('success', 'Pooja Data Updated Successfully');
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
