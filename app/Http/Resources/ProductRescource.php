<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductRescource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => [
                'normal' => $this->price,
                'compare_price' => $this->compare_price,
            ],
            'image' => $this->image_default,
            'relationship' => [
                'store' => [
                    'id' => $this->store->id,
                    'name' => $this->store->name,
                ],
                'tags' => $this->tags->pluck('name'),
                'category' => [
                    'id' => $this->category->id,
                    'name' =>$this->category->name,
                ],
            ],

        ];
    }
}
