<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Http\Requests\StorecategoryRequest;
use App\Http\Requests\UpdatecategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['categories'] = category::latest()->get();
        //$data['categories'] = category::get();

        // $data['c'] = category::paginate();
        // $category = category::latest();
        // $c = category::paginate();
        return view ('categories.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorecategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorecategoryRequest $request)
    {
        // $category = new category();
        // $category->name = $request->name;
        // $category->save();
        // return redirect()->route('categories.create');


        $categ = [
            'name' => $request->name,

        ];
        $cat = category::create($categ);
        
        if(!empty($cat)){
            return redirect()->route('categories.index')->with('success', 'Category created successfully');
        }
        else{
            return redirect()->back()->with('error', 'Category not created');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(category $category)
    {
        $data['category'] = $category;
        return view('categories.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(category $category)
    {
        //$ecate['category'] = $category;
        //return view('categories.edit', $ecate);

        // $ecate = $category;
        // return view('categories.edit', compact('ecate'));

        $data['ecat'] = $category;
        return view('categories.edit', $data);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatecategoryRequest  $request
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatecategoryRequest $request, category $category)
    {
        $updatectg = [
            'name' => $request->name,
        ];
        $c = $category->update($updatectg);
        
        if($c){
            return redirect()->route('categories.index')->with('success', 'Category Update successfully');
        }
        else{
            return redirect()->back()->with('error', 'Category not Updated');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully');
    }
}


