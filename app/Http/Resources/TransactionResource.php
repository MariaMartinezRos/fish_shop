<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
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
            'tpv' => $this->tpv,
            'serial_number' => $this->serial_number,
            'terminal_number' => $this->terminal_number,
            'operation' => $this->operation,
            'amount' => $this->amount,
            'card_number' => $this->card_number,
            'date_time' => $this->date_time,
            'transaction_number' => $this->transaction_number,
            'sale_id' => $this->sale_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
