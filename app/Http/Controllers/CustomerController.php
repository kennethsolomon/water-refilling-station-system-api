<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerPostRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Customer::get();
    }

    public function createOrUpdate(CustomerPostRequest $request)
    {
        try {
            DB::beginTransaction();

            $fields = $request->validated();

            Customer::updateOrCreate(
                ['id' => $request->id],
                $fields
            );

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
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return $customer->with(
            ['transactions' => function ($query) {
                return $query->with(['orders']);
            }],

        )->first();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        try {
            DB::beginTransaction();
            $customer->delete();

            DB::commit();
            return response()->json(
                [
                    'message' => 'Record Delete Successfully.',
                    'type' => 'sucess',
                ],
                200
            );
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return response()->json(
                [
                    'message' => 'Record Delete Successfully.',
                    'type' => 'sucess',
                ],
                405
            );
        }
    }
}
