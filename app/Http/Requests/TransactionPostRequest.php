<?php

namespace App\Http\Requests;

use App\Models\Customer;
use App\Models\Employee;
use Illuminate\Foundation\Http\FormRequest;

class TransactionPostRequest extends FormRequest
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
            'customer_id' => 'required|exists:App\Models\Customer,id',
            'employee_id' => 'required|exists:App\Models\Employee,id',
            'discount' => 'required|integer',
            'credit' => 'required|integer',
            'status' => 'required',
            'status' => 'required|string|in:done, active',

        ];
    }
}
