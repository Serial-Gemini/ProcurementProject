<?php

namespace App\Http\Controllers;

use App\Models\Receipt;
use Illuminate\Http\Request;

class ReceiptController extends Controller
{
    public function index()
{
    // 1. Fetch the data from your database (Replace 'YourModelName' with the actual model you are using)
    $records = Receipt::all(); 

    // 2. Pass the $records variable into the view
    return view('pius', compact('records'));
}

    public function apiIndex()
    {
        return response()->json(Receipt::all());
    }

    public function apiStore(Request $request)
    {
        $validated = $request->validate([
            'po_number' => 'required|string',
            'supplier_name' => 'required|string',
            'delivery_ticket' => 'required|string',
            'receiving_date' => 'required|date',
            'item_desc' => 'required|string',
            'qty_received' => 'required|integer',
            'invoice_val' => 'required|numeric'
        ]);

        $receipt = Receipt::create($validated);
        return response()->json($receipt);
    }

    public function apiUpdateStep(Request $request, $id)
    {
        $receipt = Receipt::findOrFail($id);
        $receipt->update([
            $request->field => $request->value
        ]);

        return response()->json($receipt);
    }

    public function apiVerify($id)
    {
        $receipt = Receipt::findOrFail($id);
        $receipt->update(['status' => 'Verified']);

        return response()->json($receipt);
    }

    public function apiClear()
    {
        Receipt::truncate();
        return response()->json(['status' => 'success']);
    }
}