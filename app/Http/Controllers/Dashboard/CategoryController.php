<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Movie;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_categories')->only(['index']);
        $this->middleware('permission:create_categories')->only(['create', 'store']);
        $this->middleware('permission:update_categories')->only(['edit', 'update']);
        $this->middleware('permission:delete_categories')->only(['destroy']);

    }// end of __construct
   
    public function index()
    {
        $categories = Category::whenSearch(request()->search)
        ->withCount('movies')
        ->paginate(5);
        return view('dashboard\categories\index' , compact('categories'));

    }//end of index


    public function create()
    {
        return view('dashboard\categories\create');
    }//end of create

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([

            'name'  =>   'required|unique:categories,name'
        ]);

        Category::create($request->all());


        $request->session()->flash('success', 'Data Added Successfuly');

        return redirect()->route('dashboard.categories.index');


    }//end of store

    
    public function show($id)
    {
        //
    }//end of show

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $category = Category::findOrfail($id);

        return view('dashboard\categories\edit' , compact('category'));

    }//end of edit

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([

            'name'  =>  'required|unique:categories,name'
        ]);
        
        $category = Category::findOrfail($id);

        $category->name     =   $request->name;
        $category->save();

        
        $request->session()->flash('success', 'Data Updated Successfuly');

        return redirect()->route('dashboard.categories.index');
        

    }//end of update

     
    public function destroy($id)
    {
        
        $category = Category::findOrfail($id);

        $category->delete();

        
        session()->flash('success', 'Data Deleted Successfuly');

        return redirect()->route('dashboard.categories.index');
        

    }//end of destroy
}//end of controller
