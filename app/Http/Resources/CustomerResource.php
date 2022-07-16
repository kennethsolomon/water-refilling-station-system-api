<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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
            'type' => 'Customers',
            'attributes' => [
                'fullname' => $this->fullname,
                'firstname' => $this->firstname,
                'middlename' => $this->middlename,
                'lastname' => $this->lastname,
                'address' => $this->address,
                'contact_number' => $this->contact_number,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
                'deleted_at' => $this->deleted_at,
                'classification_info' => [
                    'id' => (string)$this->classification_info->id,
                    'name' => $this->classification_info->name,
                    'description' => $this->classification_info->description,
                    'delivery_charge' => (string)$this->classification_info->delivery_charge,
                    'pickup_charge' => (string)$this->classification_info->pickup_charge,
                    'purchase_charge' => (string)$this->classification_info->purchase_charge,
                ],
                'transactions' => TransactionResource::collection($this->whenLoaded('transactions')),
                'borrows' => BorrowResource::collection($this->whenLoaded('borrows')),
            ]
        ];
    }
}
