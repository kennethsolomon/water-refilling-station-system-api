<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'transaction_id' => (string)$this->transaction_id,
            'customer_id' => (string)$this->customer_id,
            'quantity' => (string)$this->quantity,
            'type_of_service' => $this->type_of_service,
            'is_borrow' => (string)$this->is_borrow,
            'is_purchase' => (string)$this->is_purchase,
            'is_free' => (string)$this->is_free,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
            'item_info' => [
                'id' => (string)$this->item_info->id,
                'name' => $this->item_info->name,
                'description' => $this->item_info->description,
                'price' => (string)$this->item_info->price,
                'quantity' => (string)$this->item_info->quantity,
                'is_pos' => (string)$this->item_info->is_pos,
            ],
            'charge' => (string)$this->charge,
        ];
    }
}
