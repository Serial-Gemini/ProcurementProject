<?php

namespace App\Http\Controllers;

use App\Models\Requisition;
use Illuminate\Http\Request;

class RequisitionController extends Controller
{
    public function index()
    {
        $requisitions = Requisition::all();
        return view('jairuz', compact('requisitions'));
    }

    public function decide(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Approved,Rejected',
            'manager_note' => 'nullable|string',
        ]);

        $requisition = Requisition::findOrFail($id);
        $requisition->status = $request->status;
        $requisition->manager_note = $request->manager_note;
        $requisition->save();

        return response()->json(['success' => true]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'employee_id' => 'required|string',
            'item_request' => 'required|string',
            'quantity' => 'required|integer',
            'cost' => 'required|string',
            'comments' => 'nullable|string'
        ]);
        Requisition::create($validated);
        return redirect()->route('requisition.index')->with('success', 'Submitted!');
    }
}