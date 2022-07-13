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

    public function create(TransactionPostRequest $request): Response
    {
        try {
            DB::beginTransaction();

            $fields = $request->validated();

            $transaction = Transaction::create($fields);

            $this->orderService->createOrder($request, $transaction->id);

            DB::commit();
            return response()->json(
                [
                    'message' => 'Record has been successfully saved',
                    'type' => 'success',
                ],
                200
            );
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return response()->json(
                [
                    'message' => 'Failed to add Record',
                    'type' => 'warning',
                ],
                405
            );
        }
    }

    public function destroy(Transaction $transaction)
    {
        //
    }
}
