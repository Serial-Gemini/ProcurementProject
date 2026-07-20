<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $fillable = ['po_code', 'requisition_id', 'supplier_id', 'valuation', 'delivery_milestone', 'instructions', 'status'];

    public function requisition()
    {
        return $this->belongsTo(Requisition::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}