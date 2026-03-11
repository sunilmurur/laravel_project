<?php

namespace App\Http\Controllers\master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ValayaModel;
use Illuminate\Support\Facades\DB; // Import the DB facade
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;

class ValayaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title']="View Valaya";
        return view('master.valaya.view_valaya', compact('data'));
    }
       public function get_all_valaya()
    {
        /** Ajax Function call for table  */
        $valaya = ValayaModel::all();  // Retirve Query
        return DataTables::of($valaya)->make(true); // Pass to Data table
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          $data['title']="Add Valaya";
           return view('master.valaya.add_valaya', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $validatedData = $request->validate([
            'valaya_name' => 'required|string',
            'valaya_no' => 'required',

        ], [
            'valaya_name.required' => 'Valaya name field is required.',
            'valaya_no.required' => 'Valaya no field is required.',
        ]);

        $cat = new ValayaModel();
        $cat->valaya_no = $validatedData['valaya_no'];
        $cat->name = $validatedData['valaya_name'];
        if ($cat->save()) {
            return redirect()->route('Valaya.index')->with('success', 'Data saved Successfully');
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
         $data['title']="Edit Valaya";
         $edit_valaya = ValayaModel::find($id);
         return view('master.valaya.edit_valaya', compact('edit_valaya','data'));
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
        $cat = ValayaModel::find($id);
        
         $validatedData = $request->validate([
            'valaya_name' => 'required|string',
            'valaya_no' => 'required',

        ], [
            'valaya_name.required' => 'Valaya name field is required.',
            'valaya_no.required' => 'Valaya no field is required.',
        ]);
        $cat->valaya_no = $validatedData['valaya_no'];
        $cat->name = $validatedData['valaya_name'];
        if ($cat->save()) {
            return redirect()->route('Valaya.index')->with('success', 'Data Updated Successfully');
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
