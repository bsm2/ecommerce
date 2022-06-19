<?php 

namespace App\Http\Traits;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Cache;
use Yajra\DataTables\ApiResourceDataTable;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\Paginator;


/**
 * 
 */
trait ApiResponse
{
    public function success($message, $data=[], $status= 200)
    {
        //$data=$this->sortData($data);
        //$data=$this->cacheData($data);
        return response()->json([
            'sucess'=>true,
            'status'=>$status,
            'message'=>$message,
            'data'=>$data,
        ],$status);
    }

    public function viewData($message,ResourceCollection $resource)
    {
        return $this->success($message,$resource->response()->getData(true));
    }

    public function failure($message,$errors=[], $status=500)
    {
        return response()->json([
            'sucess'=>false,
            'status'=>$status,
            'message'=>$message,
            'errors'=>$errors
        ],$status);
    }

    public function sortData($data)
    {
        if (request()->has('sort_by')) {
            $sortBy = request()->sort_by;
            $data=$data->sortBy($sortBy);
        }
        return $data;
    }

    public function cacheData($data)
    {
        $url =request()->url();
        $queryParams = request()->query();
        ksort($queryParams);
        $queryString= http_build_query($queryParams);
        $fullUrl="{$url}?{$queryString}";
        return Cache::remember($fullUrl,30/6, function() use($data)
        {
            return $data;
        });
    }

    public function paginate($data)
    {
        
        Validator::validate(request()->all(),[
            'per_page'=>'integer|min:2|max:50'
        ]);
        $page = LengthAwarePaginator::resolveCurrentPage();
        $perPage=3;
        if (request()->has('per_page')) {
            $perPage=request()->per_page;
        }
        $result = $data->slice(($page-1) * $perPage , $perPage)->values();
        $paginated=  new LengthAwarePaginator($result,$data->count(),$perPage,$page,[
            'path'=>Paginator::resolveCurrentPath(),

        ]);
        $paginated->appends(request()->all());
        return $paginated;
    }
}
