<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryCollection;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Traits\ApiResponse;

class CategoryController extends Controller
{

    use ApiResponse;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories= new CategoryCollection(Category::paginate(4));
        
        return $this->success('this is all categories',$categories);
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

        $category= Category::create($data);
        return $this->success('category added successfuly',$category);
        
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
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
        return $this->success('category updated successfuly',$category);
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
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        Self::delete_icon($category->id);
        Storage::delete($category->icon);
        
        $category->delete();
        return $this->success('category deleted successfuly');
    }
}
