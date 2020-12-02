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
        return [
            'type' =>  'product',
            'id' => (string) $this->resource->id,
            'attributes' =>  [
                'name' => $this->resource->name,
                'description' => $this->resource->description,
                'category' => (string) $this->category->name,
                'price' => (string) $this->resource->price,
                'stock' => (string) $this->resource->stock
            ],
            'links' => [
                'self' => route('api.products.show', $this->getRouteKey())
            ]
        ];
    }
}
