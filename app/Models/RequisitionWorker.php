<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequisitionWorker extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function requisition()
    {
        return $this->belongsTo(Requisition::class);
    }
}