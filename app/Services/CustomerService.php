<?php

namespace App\Services;

use App\Models\Borrow;
use App\Models\Customer;

class CustomerService
{
	public function customerTransactions($customer, $request)
	{
		$customer_transactions = Customer::whereId($customer->id)->with(['transactions' => function ($query) use ($request) {
			$status = $request->get('status');
			if ($status) {
				return $query->whereStatus($status)->with(['orders']);
			} else {
				return $query->with(['orders']);
			}
		}, 'borrows'])->get();

		return $customer_transactions;
	}

	public function customerBorrowItems($customer)
	{
		$customer_borrow_items = Customer::whereId($customer->id)->with(['borrows'])->get();
		return $customer_borrow_items;
	}

	public function customerTotalBorrowItems($customer)
	{
		$customer_total_borrow_items =
			Borrow::whereCustomerId($customer->id)
			->select('id', 'order_id', 'item_id', 'quantity', 'customer_id', 'transaction_id')
			->selectRaw('sum(quantity) as total_borrow, item_id')
			->groupBy('item_id')
			->get();

		return $customer_total_borrow_items;
	}
}
