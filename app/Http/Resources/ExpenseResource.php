<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExpenseResource extends JsonResource
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
            'expense_type_id' => (string)$this->expense_type_id,
            'item_id' => (string)$this->item_id,
            'note' => $this->note,
            'price' => (string)$this->price,
            'quantity' => (string)$this->quantity,
            'operation' => (string)$this->operation,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'item_info' => [
                'id' => (string)$this->item_info->id,
                'name' => $this->item_info->name,
                'description' => $this->item_info->description,
                'price' => (string)$this->item_info->price,
                'quantity' => (string)$this->item_info->quantity,
                'is_pos' => (string)$this->item_info->is_pos,
            ],
            'expense_type_info' => [
                'id' => (string)$this->expense_type_info->id,
                'title' => $this->expense_type_info->title,
            ],
        ];
    }
}
