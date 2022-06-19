<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[ 
            'id' => $this->id,
            'name'=>$this['name_'.lang()],
            'cities'=>new CityCollection($this->cities()->with('states')->get()),
            'cities'=>$this->cities()->with('states')->get(),
            'malls'=>$this->malls()->get(),
            'currency'=>$this->currency,
            'logo'=>$this->logo,
            'code'=>$this->code,
            'mob'=>$this->mob,
            
        ];
    }
}
