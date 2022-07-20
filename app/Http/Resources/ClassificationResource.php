<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClassificationResource extends JsonResource
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
            'type' => 'Classification',
            'attributes' => [
                'name' => $this->name,
                'description' => $this->description,
                'delivery_charge' => (string)$this->delivery_charge,
                'pickup_charge' => (string)$this->pickup_charge,
                'purchase_charge' => (string)$this->purchase_charge,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ]
        ];
    }
}
