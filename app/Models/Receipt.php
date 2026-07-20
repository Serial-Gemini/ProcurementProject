<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;

    protected $fillable = [
        'po_number', 
        'supplier_name', 
        'delivery_ticket', 
        'receiving_date', 
        'item_desc', 
        'qty_received', 
        'invoice_val', 
        'check_price', 
        'check_delivery', 
        'check_payment', 
        'status'
    ];

    protected $casts = [
        'check_price' => 'boolean',
        'check_delivery' => 'boolean',
        'check_payment' => 'boolean',
    ];
}