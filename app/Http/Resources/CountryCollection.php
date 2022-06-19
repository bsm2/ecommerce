<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\CityCollection;
use App\Http\Resources\CountryResource;
class CountryCollection extends ResourceCollection
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
            'data' => CountryResource::collection($this->collection),
            // 'pagination' => [
            //     'meta'=>[
            //         'total' => $this->total(),
            //         'count' => $this->count(),
            //         'per_page' => $this->perPage(),
            //         'current_page' => $this->currentPage(),
            //         'total_pages' => $this->lastPage(),
            //         'from' => $this->firstItem(),
            //         'to' => $this->lastItem(),
            //     ],
            //     'links'=>[
            //         'path' => $this->path(),
            //         'prev_page_url' => $this->previousPageUrl(),
            //         'last_page_url' => $this->url($this->lastPage()),
            //         'next_page_url' => $this->nextPageUrl(),
            //         'first_page_url' => $this->url(1),
            //     ],

            // ],
        ];
    }
}
