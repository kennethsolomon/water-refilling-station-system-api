<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpensePostRequest extends FormRequest
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
            'expense_type_id' => 'required|exists:App\Models\ExpenseType,id',
            'item_id' => 'required|exists:App\Models\Item,id',
            'note' => 'required|string',
            'price' => 'required|integer',
            'quantity' => 'required|integer',
            'operation' => 'required|string',
        ];
    }
}
