<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
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
            'customer_id' => (string)$this->customer_id,
            'discount' => (string)$this->discount,
            'credit' => (string)$this->credit,
            'status' => (string)$this->status,
            'transaction_date' => (string)$this->transaction_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'latest_transaction' => $this->latest_transaction,
            'deleted_at' => $this->deleted_at,
            'employee_info' => [
                'id' => (string)$this->employee_info->id,
                'fullname' => $this->employee_info->fullname,
                'firstname' => $this->employee_info->firstname,
                'middlename' => $this->employee_info->middlename,
                'lastname' => $this->employee_info->lastname,
                'address' => $this->employee_info->address,
                'contact_number' => $this->employee_info->contact_number,
            ],
            'orders' => OrderResource::collection($this->whenLoaded('orders')),
        ];
    }
}
