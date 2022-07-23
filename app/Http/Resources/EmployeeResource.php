<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
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
            'type' => 'Employee',
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
            ]

        ];
    }
}
