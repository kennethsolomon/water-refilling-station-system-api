<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\Order;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class OrderService
{
	public function createOrder($request, $transaction_id)
	{
		try {
			DB::beginTransaction();

			$validator = Validator::make($request->all(), [
				'orders.*.item_id' => 'required|exists:App\Models\Item,id',
				'orders.*.quantity' => 'required|integer',
				'orders.*.type_of_service' => ['required', 'string', Rule::in(['delivery', 'purchase', 'pickup'])],
				'orders.*.is_borrow' => 'required|boolean',
				'orders.*.is_free' => 'required|boolean',
			]);

			if ($validator->fails()) {
				abort(400);
			}

			foreach ($validator->validate()['orders'] as $order) {
				Order::create($order + ['transaction_id' => $transaction_id]);
			}

			DB::commit();
		} catch (\Throwable $th) {
			throw $th;
			DB::rollBack();
		}
	}
}
