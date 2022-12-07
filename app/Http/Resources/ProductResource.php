<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => 'Rp' . number_format($this->price, thousands_separator: '.'),
            'category' => $this->category,
            'created_at' => $this->created_at->format('j M Y, g:i a'),
            'updated_at' => $this->updated_at->format('j M Y, g:i a'),
        ];
    }
}
