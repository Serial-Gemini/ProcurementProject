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
        
        // FIXED: Changed from 'Approved' to fetch all requisitions so 'Pending' ones show up in your dropdown
        $requisitions = Requisition::all(); 
        
        // Keep active suppliers
        $suppliers = Supplier::where('status', 'Active')->get();
        
        return view('jay', compact('purchaseOrders', 'requisitions', 'suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'requisition_id' => 'required|exists:requisitions,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'delivery_milestone' => 'required|date',
            'instructions' => 'nullable|string'
        ]);

        $requisition = Requisition::find($request->requisition_id);
        
        // Clean currency format symbols (e.g., "$850" -> 850)
        $cleanCost = preg_replace('/[^0-9.]/', '', $requisition->cost);
        $totalValuation = (float)$cleanCost * $requisition->quantity;

        PurchaseOrder::create([
            'po_code' => 'PO-' . date('Y') . '-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT),
            'requisition_id' => $request->requisition_id,
            'supplier_id' => $request->supplier_id,
            'valuation' => $totalValuation,
            'delivery_milestone' => $request->delivery_milestone,
            'instructions' => $request->instructions,
            'status' => 'Pending Signature'
        ]);

        return redirect()->route('po.index')->with('success', 'Purchase Order generated!');
    }
}