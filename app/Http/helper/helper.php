<?php

use App\Models\Setting;
use App\Models\Category;

if(!function_exists('settings')){

    function settings()
    {
        return Setting::orderBy('id', 'DESC')->first();
    }

}

if(!function_exists('lang')){

    function lang()
    {
        if (session()->has('lang')) {
            return session('lang');
        }else {
            return request()->session()->put('lang',settings()->main_lang);
        }
    }

}

if(!function_exists('get_parent')){

    function get_parent($cat_id)
    {
        $cat= Category::find($cat_id);
        if ($cat->parent_id != null && $cat->parent_id > 0 ) {
            return get_parent($cat->parent_id).','.$cat_id;
        }else{
            return $cat_id;
        }
    }

}

if(!function_exists('get_cat')){

    function get_cat($select=null,$hide_cat=null)
    {
        $cats = Category::selectRaw('name_'.lang().' as text')
                ->selectRaw('id as id')
                ->selectRaw('parent_id as parent')
                ->get(['text','id','parent']); 
        $cat_arr=[];
        foreach ($cats as $cat) {
            $list_arr=[];
            $list_arr['icon']='';
            $list_arr['li_attr']='';
            $list_arr['a_attr']='';
            $list_arr['children']=[];
            if ($select !==null && $select == $cat->id) {
                $list_arr['state']=[
                    'opened'=>true,
                    'selected'=>true
                ];
            }else if($hide_cat !==null && $hide_cat == $cat->id){
                $list_arr['state']=[
                    'opened'=>false,
                    'selected'=>false,
                    'disabled'=>true,
                    'hidden'=>true
                ];
            }

            $list_arr['text']=$cat->text;
            $list_arr['id']=$cat->id;
            $list_arr['parent']=$cat->parent > 0?$cat->parent:'#';
            
            array_push($cat_arr,$list_arr);
            
        }
        return json_encode($cat_arr,JSON_UNESCAPED_UNICODE) ; 
    }

}

if(!function_exists('direction')){

    function direction()
    {
        if (session()->has('lang')) {
            if (session('lang')=='ar') {
                return 'rtl';
            }else {
                return 'ltr';
            }
        }else {
            return 'rtl';
        }
    }

}