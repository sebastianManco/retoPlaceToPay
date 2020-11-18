<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return[
            'name' => (string) $this->name,
            'description' => (string) $this->description,
            'category' => (string) $this->category->name,
            'price' => (int) $this->price,
            'stock' => (int) $this->stock
        ];
    }
}
