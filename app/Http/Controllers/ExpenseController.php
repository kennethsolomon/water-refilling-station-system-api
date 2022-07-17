<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpensePostRequest;
use App\Http\Resources\ExpenseResource;
use App\Models\Expense;
use App\Models\ExpenseType;
use Exception;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ExpenseController extends Controller
{
    public function index()
    {
        return ExpenseResource::collection(Expense::all())->response()->setStatusCode(200);
    }

    public function createExpense(ExpensePostRequest $request)
    {
        try {
            DB::beginTransaction();

            $expense_type_id = $request->expense_type_id;
            if (strtolower(ExpenseType::find($expense_type_id)->title) != 'item') {
                if ($request->quantity > 0) {
                    throw new Exception("Quantity for non Item must be 0 or Null.", 500);
                }

                if ($request->operation != 'add') {
                    throw new Exception("Operation for non Item must be Add or Null.", 500);
                }
            }

            $fields = $request->validated();

            $expense = Expense::create($fields);

            DB::commit();
            return (new ExpenseResource($expense))->response()->setStatusCode(201);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response(null, Response::HTTP_NOT_IMPLEMENTED);
        }
    }
}
