<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Resources\OrderResource;
use App\Interfaces\OrderRepositoryInterface;
use Illuminate\Support\Facades\DB;

/**
 *
 */
class OrderController extends Controller
{
    /**
     * @var OrderRepositoryInterface
     */
    protected OrderRepositoryInterface $orderRepository;

    /**
     * @param OrderRepositoryInterface $orderRepository
     */
    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        $data = $request->validated();

        try{
            DB::beginTransaction();

            $order = $this->orderRepository->store($data) ?? throw new \Exception('Error creating order');

            DB::commit();
            return ApiResponseClass::sendResponse(new OrderResource($order), 'Order Created Successfully', 201);

        }catch(\Exception $ex){
            return ApiResponseClass::rollback($ex);
        }
    }

}
