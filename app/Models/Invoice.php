<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['order_id', 'invoice_number', 'invoice_date', 'due_date', 'total_amount', 'status'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
