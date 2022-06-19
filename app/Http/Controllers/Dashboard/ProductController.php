<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\ProductDatatable;
use App\Http\Controllers\Controller;
use App\Models\OtherData;
use App\Models\Product;
use App\Models\ProductMall;
use App\Models\Size;
use App\Models\Weight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Upload;

class productController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductDatatable $product)
    {
        $title= __('site.products'); 
        return $product->render('dashboard.products.index',compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product= Product::create([
            'title'=>'',
            'content'=>'',
            'photo'=>'',
            'weight'=>'',
            'other_data'=>'',
        ]);
        if (!empty($product)) {
            return redirect()->route('dashboard.product.edit',['product'=>$product]);
        }
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

            
        ]);


        Product::create($data);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.product.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $title= __('site.edit_add_product'); 
        return view('dashboard.products.product',compact('title','product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'title' => 'required',
            'content'=>'required',
            'category_id'=>'required|numeric',
            'trade_id'=>'required|numeric',
            'manu_id'=>'required|numeric',
            'color_id'=>'sometimes|nullable|numeric',
            'size'=>'sometimes|nullable|numeric',
            'size_id'=>'sometimes|nullable|numeric',
            'currency_id'=>'sometimes|nullable|numeric',
            'weight'=>'sometimes|nullable',
            'weight_id'=>'sometimes|nullable|numeric',
            'status'=>'sometimes|nullable|in:pending,refused,active',
            'stock'=>'required|numeric',
            'reason'=>'sometimes|nullable',
            'end_at'=>'required|date',
            'start_at'=>'required|date',
            'offer_end_at'=>'sometimes|nullable|date',
            'offer_start_at'=>'sometimes|nullable|date',
            'price'=>'required|numeric',
            'offer_price'=>'sometimes|nullable|numeric'
        ]);

        if ($request->has('mall')) {
            ProductMall::where('product_id',$product->id)->delete();
            foreach ($request->mall as $mall) {
                if (!empty($mall)) {
                    ProductMall::create([
                        'product_id'=>$product->id,
                        'mall_id'=>$mall
                    ]);
                }
            }
        }

        if ($request->has('other_data')) {
            OtherData::where('product_id',$product->id)->delete();
            foreach ($request->other_data as $key => $value) {
                //return response(['data'=>$value],200);
                if (!empty($value['input_key']) && !empty($value['input_value'])) {
                    $value['product_id']=$product->id;
                    OtherData::create($value);
                }
            }
        }
        $product->update($data);
        return response(['status'=>true ,'message'=> __('site.updated_successfully'),'product_data'=>$data],200);
    }

    public function update_image(Request $request,$id)
    {

        if ($request->hasFile('photo')) {
            $product = Product::where('id',$id)->update([
                'photo'=> Upload::up([
                    'file'=>'photo',
                    'path'=>'products/'.$id.'/main',
                    'upload_type'=>'single',
                ])
            ]);
            return response(['status'=>true],200);
        }
    }

    public function delete_image(Request $request,$id)
    {
        $product =Product::find($id);
        Storage::delete($product->photo);
        $product->photo='';
        $product->save();
        return response(['status'=>true],200);
    }

    public function upload_file(Request $request,$id)
    {
        if ($request->hasFile('file')) {
            $fId  = Upload::up([
                'file'=>'file',
                'path'=>'products/'.$id,
                'upload_type'=>'files',
                'file_type'=>'product',
                'relation_id'=>$id,
            ]); 
            return response(['status'=>true,'id'=>$fId],200);
        }
    }

    public function delete_file(Request $request)
    {
        if ($request->has('id')) {
            Upload::delete($request->id);
        }
    }

    public function shipping_info(Request $request)
    {
        if ($request->ajax() && $request->has('id')) {
            $categories = array_diff(explode(',', get_parent($request->id)),[$request->id]);
            $product = Product::find($request->product_id);

            $sizes = Size::where('is_public','yes')
                        ->whereIn('category_id', $categories)
                        ->orWhere('category_id',$request->id)->pluck('name_'.lang(),'id');
            $weights = Weight::pluck('name_'.lang(),'id');
            return view('dashboard.products.ajax.shipping_info',compact('weights','sizes','product'))->render();
        }else {
            return 'choose category';
        }
    }

    public function destroy_all(Request $request)
    {
        if (is_array($request->item)) {
            foreach ($request->item as $id) {
                $product=Product::find($id);
                $this->delete_product($product);
            }
        }
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(product $product)
    {
        $this->delete_product($product);
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.product.index');
    }

    public function delete_product(product $product)
    {
        Storage::delete($product->photo);
        Upload::delete_product_files($product);
        $product->delete();
    }
}
