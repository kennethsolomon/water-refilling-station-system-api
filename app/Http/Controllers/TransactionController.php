<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionPostRequest;
use App\Models\Transaction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(TransactionPostRequest $request)
    {
        try {
            DB::beginTransaction();

            $fields = $request->validated();

            Transaction::create($fields);

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
