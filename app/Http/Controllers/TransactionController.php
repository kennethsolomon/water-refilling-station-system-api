<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionPostRequest;
use App\Http\Resources\TransactionResource;
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

        if (request()->has('search')) {
            $transaction->whereLike(
                [
                    'id',
                    'transaction_date'
                ],
                request('search')
            );
        }

        return request()->has('page') ?

            TransactionResource::collection($transaction
                ->with(['orders'])
                ->paginate(intval(request('rows')))->withQueryString())
            // ->paginate(intval(request('rows')))->appends(request()->all()))
            :
            TransactionResource::collection($transaction
                ->with(['orders'])
                ->get())
            ->response()
            ->setStatusCode(200);
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
            return (new TransactionResource($transaction))->response()->setStatusCode(201);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => $th->getMessage(),
            ], 501);
        }
    }

    public function destroy(Transaction $transaction)
    {
        try {
            DB::beginTransaction();
            $transaction->delete();

            DB::commit();

            return response(null, Response::HTTP_OK);
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return response(null, Response::HTTP_NOT_IMPLEMENTED);
        }
    }
}
