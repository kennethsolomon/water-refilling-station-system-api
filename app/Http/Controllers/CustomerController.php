<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerPostRequest;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use App\Services\CustomerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class CustomerController extends Controller
{
    protected $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CustomerResource::collection(Customer::all())->response()->setStatusCode(200);
    }

    /**
     * Create or Update the specified resource.
     *
     * @param  \App\Http\Requests  $request
     * @return \Illuminate\Http\Response
     */
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
            return (new CustomerResource($customer))->response()->setStatusCode(201);
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
        return (new CustomerResource($customer))->response()->setStatusCode(202);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function showCustomerTransactions(Customer $customer, Request $request)
    {
        $customer_transactions = $this->customerService->customerTransactions($customer, $request);
        return CustomerResource::collection($customer_transactions)->response()->setStatusCode(202);
    }

    public function showCustomerBorrowItems(Customer $customer)
    {
        $customer_borrow_items = $this->customerService->customerBorrowItems($customer);
        return CustomerResource::collection($customer_borrow_items)->response()->setStatusCode(202);
    }

    public function showCustomerTotalBorrowItems(Customer $customer)
    {
        $customer_total_borrow_items = $this->customerService->customerTotalBorrowItems($customer);
        return $customer_total_borrow_items;
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

            return response(null, Response::HTTP_OK);
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return response(null, Response::HTTP_NOT_IMPLEMENTED);
        }
    }
}
