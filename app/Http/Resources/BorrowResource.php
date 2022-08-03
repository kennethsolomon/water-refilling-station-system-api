<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BorrowResource extends JsonResource
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
            'order_id' => (string)$this->order_id,
            'quantity' => (string)$this->quantity,
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
        ];
    }
}
