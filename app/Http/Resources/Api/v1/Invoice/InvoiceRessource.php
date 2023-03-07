<?php

namespace App\Http\Resources\Api\v1\Invoice;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceRessource extends JsonResource
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
            'invoice_number' => $this->invoice_number,
            'total_price' => $this->total_price,
            'total_price_excluding_vat' => $this->total_price_excluding_vat,
            'total_vat' => $this->total_vat,
            'state' => $this->state,
            'user' => User::where('id', $this->user_id)->first()->name,
            'created_at' => $this->created_at,
            
        ];
    }
}
