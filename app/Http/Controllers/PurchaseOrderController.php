<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\Models\Requisition;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    public function index()
    {
        $purchaseOrders = PurchaseOrder::with(['requisition', 'supplier'])->get();
        
        // ONLY fetch requisitions that have been approved by a manager
        $requisitions = Requisition::where('status', 'Approved')->get(); 
        
        // Keep active suppliers
        $suppliers = Supplier::where('status', 'Active')->get();
        
        return view('jay', compact('purchaseOrders', 'requisitions', 'suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'po_number'      => 'required|string',
            'supplier'       => 'required|string',
            'amount'         => 'required|numeric',
            'requisition_id' => 'required|exists:requisitions,id',
        ]);

        PurchaseOrder::create([
            'po_number'      => $request->po_number,
            'supplier'       => $request->supplier,
            'amount'         => $request->amount,
            'requisition_id' => $request->requisition_id,
            'status'         => 'prepared',
        ]);

        return redirect()->route('po.index')->with('success', 'Purchase Order generated and saved successfully!');
    }
}