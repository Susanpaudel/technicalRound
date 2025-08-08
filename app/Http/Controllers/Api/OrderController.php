<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Order;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\service\OrderStatusService;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\OrderCreateRequest;
use App\Http\Requests\Order\OrderUpdateRequest;
use App\Http\Requests\Order\UpdateStatusRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class OrderController extends Controller
{
    use ApiResponse;
    public $order=null;
    public function __construct(Order $order)
    {
        $this->order = $order;
        
    }
  
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $query = $this->order->query();
    
        if ($request->filled('status')) {
            $query->where('order_status', $request->status);
        }
    
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        } elseif ($request->filled('start_date')) {
            $query->where('created_at', '>=', $request->start_date);
        } elseif ($request->filled('end_date')) {
            $query->where('created_at', '<=', $request->end_date);
        }
    
        $orders = $query->latest()->paginate(10);
    
        return $this->successResponse($orders, 'Orders fetched successfully');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderCreateRequest $request): JsonResponse
    {
        $data = $request->validated();
        try{
            $order = Order::create($data);
            return $this->successResponse($order, 'Order created successfully', 201);
        }catch (Exception $e) {
            Log::error('Order creation failed: ' . $e->getMessage());
            return $this->errorResponse('Failed to create order. Please try again later.', 500);
        }
      
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        try {
            $order = $this->order->findOrFail($id);
        }  catch (ModelNotFoundException $e) {
            return $this->notFoundResponse('Order not found');
        }
        return $this->successResponse($order, 'Order fetched successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrderUpdateRequest $request, $id,OrderStatusService $orderService): JsonResponse
    {
        try {
            $order = Order::findOrFail($id);
    
            $error = $orderService->validateUpdate($order, $request);
            if ($error) {
                return $this->errorResponse($error['message'], $error['code']);
            }
    
            $data = $request->all();
            $order->update($data);
    
            return $this->successResponse($order, 'Order updated successfully.', 200);
    
        } catch (ModelNotFoundException $e) {
            return $this->notFoundResponse('Order not found.');
        } catch (Exception $e) {
            Log::error('Order update failed: ' . $e->getMessage());
            return $this->errorResponse('An unexpected error occurred.', 500);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        try{
            $order = $this->order->findOrFail($id);
            $order->delete();
            return $this->successResponse($order,'Order deleted successfully.', 200);
        } catch (ModelNotFoundException $e) {
            return $this->notFoundResponse('Order not found.');
        }
        catch (Exception $e) {
            Log::error('Order delete failed: ' . $e->getMessage());
            return $this->errorResponse('An unexpected error occurred.', 500);
        }

    }


    public function status(UpdateStatusRequest $request, $id,OrderStatusService $orderService): JsonResponse
    {
        try {
            $order = Order::findOrFail($id);
            $error = $orderService->validateUpdate($order, $request);
        if ($error) {
            return $error;
        }
        $data = $request->only('order_status');
        $order->update($data);

        return $this->successResponse($order, 'Order updated successfully.', 200);

        } catch (ModelNotFoundException $e) {
            return $this->notFoundResponse('Order not found.');
        }
        catch (Exception $e) {
            Log::error('Order status changed failed: ' . $e->getMessage());
            return $this->errorResponse('An unexpected error occurred.', 500);
        }
    }
  
}
