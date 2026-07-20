<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    // app/Http/Controllers/SupplierController.php

// app/Http/Controllers/SupplierController.php

public function index()
{
    // 1. Fetch the data
    $suppliers = \App\Models\Supplier::all(); 

    // 2. Pass it to the view 'suppliers'
    // Ensure the filename in resources/views/ is suppliers.blade.php
    return view('lescano', compact('suppliers')); 
}

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'contact_person' => 'required|string',
            'email' => 'required|email|unique:suppliers,email',
            'phone' => 'nullable|string',
            'rating' => 'nullable|numeric|between:1,5',
            'status' => 'required|in:Active,Inactive'
        ]);

        Supplier::create($validated);

        return redirect()->route('supplier.index')->with('success', 'Supplier successfully added!');
    }
}