<?php

namespace App\Http\Controllers;

use App\Models\Requisition;
use Illuminate\Http\Request;

class RequisitionController extends Controller
{
    public function index()
    {
        // Eager load workers relationship and fetch latest requisitions
        $requisitions = Requisition::with('workers')->latest()->get();
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
            'form_type' => 'required|in:individual,management',
            'first_name' => 'nullable|string',
            'last_name' => 'nullable|string',
            'employee_id' => 'nullable|string',
            'department' => 'nullable|string',
            'item_request' => 'required|string',
            'quantity' => 'required|integer',
            'cost' => 'required|string',
            'comments' => 'nullable|string',
            'status' => 'nullable|string',
            'workers' => 'nullable|array',
            'workers.*.first_name' => 'required_with:workers|string',
            'workers.*.last_name' => 'required_with:workers|string',
            'workers.*.employee_id' => 'required_with:workers|string',
        ]);

        // Create main requisition record
        $requisition = Requisition::create([
            'form_type' => $request->form_type,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'employee_id' => $request->employee_id,
            'department' => $request->department,
            'item_request' => $request->item_request,
            'quantity' => $request->quantity,
            'cost' => $request->cost,
            'comments' => $request->comments,
            'status' => $request->status ?? 'Pending',
        ]);

        // If management request contains workers, save them into DB
        if ($request->form_type === 'management' && $request->has('workers')) {
            foreach ($request->workers as $worker) {
                $requisition->workers()->create([
                    'first_name' => $worker['first_name'],
                    'last_name' => $worker['last_name'],
                    'employee_id' => $worker['employee_id'],
                ]);
            }
        }

        return redirect()->route('requisition.index')->with('success', 'Submitted!');
    }
}