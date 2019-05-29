<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name'=>$this->name,
            'totalPrice'=>floor((1-$this->discount/100)*$this->price),
            'discount'=>$this->discount,
            'rating'=> $this->reviews->count() > 0 ? round($this->reviews->sum('star')/$this->reviews->count(),1) : "there is no rating",
            'href' => [
                'detail'=> route('products.show',$this->id),
            ]
        ];
    }
}
