<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpenseTypePostRequest;
use App\Http\Resources\ExpenseTypeResource;
use App\Models\ExpenseType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ExpenseTypeController extends Controller
{
    public function updateOrCreateExpense(ExpenseTypePostRequest $request)
    {
        try {
            DB::beginTransaction();

            $fields = $request->validated();

            $expense_type = ExpenseType::updateOrCreate(
                ['id' => $request->id],
                $fields
            );

            DB::commit();
            return (new ExpenseTypeResource($expense_type))->response()->setStatusCode(201);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response(null, Response::HTTP_NOT_IMPLEMENTED);
        }
    }

    public function destroy(ExpenseType $expense_type)
    {
        try {
            DB::beginTransaction();
            $expense_type->delete();

            DB::commit();

            return response(null, Response::HTTP_OK);
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return response(null, Response::HTTP_NOT_IMPLEMENTED);
        }
    }
}
