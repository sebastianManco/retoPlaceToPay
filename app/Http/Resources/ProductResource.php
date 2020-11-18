<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{

    public static $wrap = 'product';
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => (int)  $this->id,
            'name' => (string) $this->name,
            'description' => (string) $this->description,
            'category' => (string) $this->category->name,
            'price' => (int) $this->price,
            'stock' => (int) $this->stock
        ];
    }
}
