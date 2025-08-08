<?php

namespace App\service;

use App\Traits\ApiResponse;

class OrderStatusService
{
    use ApiResponse;
    /**
     * Create a new class instance.
     */
    public function validateUpdate($order, $request)
    {
        if ($order->order_status == 'completed' || $order->order_status == 'cancelled') {
            return $this->errorResponse($order->order_status.' orders cannot be updated.', 403);
        }

        if ($order->order_status !== 'pending'
            && $request->has('order_status')
            && $request->order_status == 'cancelled') {
                return $this->errorResponse('Only pending orders can be cancelled.', 403);
        }

        return null;
    }
}
