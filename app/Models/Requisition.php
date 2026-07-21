<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RequisitionWorker;

class Requisition extends Model
{
    use HasFactory;

    protected $fillable = [
        'form_type',
        'first_name',
        'last_name',
        'employee_id',
        'department',
        'item_request',
        'quantity',
        'cost',
        'comments',
        'status',
        'manager_note',
    ];

    public function workers()
    {
        return $this->hasMany(RequisitionWorker::class);
    }
}