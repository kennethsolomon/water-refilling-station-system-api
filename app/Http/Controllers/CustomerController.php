<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerPostRequest;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

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

    public function updateOrCreateCustomer(CustomerPostRequest $request)
    {
        try {
            DB::beginTransaction();

            $fields = $request->validated();

            $customer = Customer::updateOrCreate(
                ['id' => $request->id],
                $fields
            );

            DB::commit();
            return response($customer, Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return response(null, Response::HTTP_NOT_IMPLEMENTED);
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

            return response(null, Response::HTTP_NO_CONTENT);
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return response(null, Response::HTTP_NOT_IMPLEMENTED);
        }
    }
}
