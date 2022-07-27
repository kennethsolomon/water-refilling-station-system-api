<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'description' => 'required|string',
            'pickup_price' => 'required|integer',
            'delivery_price' => 'required|integer',
            'purchase_price' => 'required|integer',
            'quantity' => 'required|integer',
            'is_pos' => 'required|boolean',
        ];
    }
}
