<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\CategoryDatatable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Contracts\DataTable;
use Upload;

class categoryController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:category-read', ['only' => ['index']]);
        $this->middleware('permission:category-create', ['only' => ['create','store']]);
        $this->middleware('permission:category-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:category-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title= __('site.categories'); 
        return view('dashboard.categories.index',compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.categories.create',['title'=>__('site.create')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name_ar' => 'required',
            'name_en' => 'required',
            'description' => 'sometimes|nullable|numeric',
            'keyword' => 'sometimes|nullable',
            'icon' => 'image|sometimes|nullable',
            'parent_id' => 'sometimes|nullable',
            
        ]);

        if ($request->hasFile('icon')) {
            $data['icon'] = Upload::up([
                'file'=>'icon',
                'path'=>'categories',
                'upload_type'=>'single'
            ]); 
        }

        Category::create($data);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $title= __('site.edit'); 
        return view('dashboard.categories.edit',compact('title','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name_ar' => 'required',
            'name_en' => 'required',
            'descriptin' => 'sometimes|nullable|numeric',
            'keyword' => 'sometimes|nullable',
            'icon' => 'image|sometimes|nullable',
            'parent_id' => 'sometimes|nullable',
            
        ]);

        if ($request->hasFile('icon')) {
            $data['icon'] = Upload::up([
                'file'=>'icon',
                'path'=>'categories',
                'upload_type'=>'single',
                'delete_file'=>$category->icon
            ]); 
        }

        $category->update($data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.category.index');
    }

    public static function delete_icon($id)
    {
        $children_cats = Category::where('parent_id',$id)->get();
        foreach($children_cats as $child) {
            Self::delete_icon($child->id);
            $child->delete();
            if (!empty($child->icon)) {
                Storage::has($child->icon)? Storage::delete($child->icon):'';
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        Self::delete_icon($category->id);
        Storage::delete($category->icon);
        
        $category->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.category.index');
    }
}
