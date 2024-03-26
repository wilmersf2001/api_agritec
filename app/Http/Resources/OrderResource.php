<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'order_code' => $this->order_code,
            'customer_name' => $this->customer_name,
            'customer_ap_paterno' => $this->customer_ap_paterno,
            'customer_ap_materno' => $this->customer_ap_materno,
            'customer_phone' => $this->customer_phone,
            'customer_address' => $this->customer_address,
            'customer_email' => $this->customer_email,
            'customer_note' => $this->customer_note,
            'payment_method' => $this->payment_method,
            'subtotal' => $this->subtotal,
            'tax' => $this->tax,
            'total' => $this->total,
            'status' => $this->status,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
