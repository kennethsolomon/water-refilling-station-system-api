<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class OrderService
{
	public function updateOrCreateOrder($request, $transaction_id)
	{
		$validator = Validator::make($request->all(), [
			'customer_id' => 'required|exists:App\Models\Customer,id',
			'orders.*.id' => 'sometimes|required',
			'orders.*.item_id' => 'required|exists:App\Models\Item,id',
			'orders.*.quantity' => 'required|integer',
			'orders.*.type_of_service' => ['required', 'string', Rule::in(['delivery', 'purchase'])],
			'orders.*.is_borrow' => 'required|boolean',
			'orders.*.is_purchase' => 'required|boolean',
			'orders.*.is_free' => 'required|boolean',
		]);

		if ($validator->fails()) {
			abort(500);
		}

		foreach ($validator->validate()["orders"] as $order) {
			if (!array_key_exists('id', $order)) {
				$order['id'] = null;
			}
			Order::updateOrCreate(
				['id' => $order["id"]],
				$order + ['customer_id' => $request->customer_id, 'transaction_id' => $transaction_id]
			);
		}
	}
}
