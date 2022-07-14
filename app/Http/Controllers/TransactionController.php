<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionPostRequest;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

use App\Services\OrderService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TransactionController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index(Request $request)
    {
        $transaction = Transaction::query();

        if ($request->get('id')) {
            $transaction->whereId($request->get('id'));
        }

        if ($request->get('status')) {
            $transaction->whereStatus($request->get('status'));
        }

        return $transaction->get();
    }

    public function updateOrCreateTransaction(TransactionPostRequest $request)
    {
        try {
            DB::beginTransaction();

            $fields = $request->validated();

            $transaction = Transaction::updateOrCreate(
                ['id' => $request->id],
                $fields
            );

            if ($request->orders) {
                $this->orderService->updateOrCreateOrder($request, $transaction->id);
            }

            DB::commit();
            return response($transaction, Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response(null, Response::HTTP_NOT_IMPLEMENTED);
        }
    }

    public function destroy(Transaction $transaction)
    {
        //
    }
}
