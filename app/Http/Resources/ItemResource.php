<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
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
            'id' => (string)$this->id,
            'type' => 'Item',
            'attributes' => [
                'name' => $this->name,
                'description' => $this->description,
                'pickup_price' => (string)$this->pickup_price,
                'delivery_price' => (string)$this->delivery_price,
                'purchase_price' => (string)$this->purchase_price,
                'quantity' => (string)$this->quantity,
                'is_pos' => (string)$this->is_pos,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ]
        ];
    }
}
