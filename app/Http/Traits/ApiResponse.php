<?php 

namespace App\Http\Traits;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Yajra\DataTables\ApiResourceDataTable;

/**
 * 
 */
trait ApiResponse
{
    public function success($message, $data=[], $status= 200)
    {
        return response()->json([
            'sucess'=>true,
            'status'=>$status,
            'message'=>$message,
            'data'=>$data,
        ],$status);
    }

    public function getData($message,ResourceCollection $resource)
    {
        return $this->success($message,$resource);
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
}
