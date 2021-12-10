<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'data' =>$this->collection->transform(function ($data) {
                return[ 
                    'id' => $data->id,
                    'name'=>$data['name_'.lang()],
                    'parent'=>$data->parents()->get(),
                    'icon'=>$data->icon,
                    'description'=>$data->description,
                    'keyword'=>$data->keyword,
                    
                ];
            }),
            'pagination' => [
                'meta'=>[
                    'total' => $this->total(),
                    'count' => $this->count(),
                    'per_page' => $this->perPage(),
                    'current_page' => $this->currentPage(),
                    'total_pages' => $this->lastPage(),
                    'from' => $this->firstItem(),
                    'to' => $this->lastItem(),
                ],
                'links'=>[
                    'path' => $this->path(),
                    'prev_page_url' => $this->previousPageUrl(),
                    'last_page_url' => $this->url($this->lastPage()),
                    'next_page_url' => $this->nextPageUrl(),
                    'first_page_url' => $this->url($this->firstItem()),
                ],

            ],
        ];
    }
}
