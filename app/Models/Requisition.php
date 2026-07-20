<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requisition extends Model
{
    use HasFactory;

    protected $fillable = [
    'first_name', 'last_name', 'employee_id', 'item_request', 
    'quantity', 'cost', 'comments', 'status', 'manager_note'
];
}