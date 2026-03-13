<?php

namespace App\Http\Controllers\master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryModel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['title']="View Category";
        return view('master.category.view_category', compact('data'));
    }

    public function get_all_category()
    {
        /** Ajax Function call for table  */
        $category = CategoryModel::all();  // Retirve Query
        return DataTables::of($category)->make(true); // Pass to Data table
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title']="Add Category";
        return view('master.category.add_category', compact('data'));
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
            'name' => 'required|string|min:3',
            'description' => 'required|string|min:3',
        ], [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name field must be a string.',
            'name.max' => 'The name field must not exceed 5 characters.',
            'description.required' => 'The description field is required.',
            'description.string' => 'The description field must be a string.',
            'description.min' => 'The description field must be at least 6 characters.',
        ]);

        $cat = new CategoryModel();
        $cat->name = $validatedData['name'];
        $cat->description = $validatedData['description'];
        if ($cat->save()) {
            return redirect()->route('Category.index')->with('success', 'Category saved Successfully');
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
        $data['title']="Edit Category";
        $edit_category = CategoryModel::find($id);
        return view('master.category.edit_category', compact('edit_category','data'));
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
        $category = CategoryModel::find($id);
        $validatedData = $request->validate([
            'name' => 'required|min:3',
            'description' => 'required|min:3',
            Rule::unique('category', 'name')->ignore($category->name),

        ], [
            'name.required' => 'The name field is required.',
            'name.max' => 'The name field must not exceed 5 characters.',
            'description.required' => 'The description field is required.',
            'description.min' => 'The description field must be at least 6 characters.',
        ]);
        
        $category->name = $validatedData['name'];
        $category->description = $validatedData['description'];
       // $category->save();
        if ($category->save()) {
            // Data saved successfully
            return redirect()->route('Category.index')->with('success', 'Category Updated Successfully');
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
