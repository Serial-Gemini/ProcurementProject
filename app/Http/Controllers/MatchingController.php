<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Receipt;

class ReceiptController extends Controller
{
    public function index()
    {
        $dbReceipts = Receipt::all();

        // Target dummy data structures for explicit 3-way rendering
        $poMap = [
            'PO-2026-001' => ['item_id' => 'ITEM-101', 'quantity_ordered' => 20, 'unit_price' => 150.00],
            'PO-2026-002' => ['item_id' => 'ITEM-102', 'quantity_ordered' => 15, 'unit_price' => 300.00],
            'PO-2026-003' => ['item_id' => 'ITEM-103', 'quantity_ordered' => 50, 'unit_price' => 25.00],
            'PO-2026-004' => ['item_id' => 'ITEM-104', 'quantity_ordered' => 10, 'unit_price' => 120.00],
            'PO-2026-005' => ['item_id' => 'ITEM-105', 'quantity_ordered' => 40, 'unit_price' => 15.00],
            'PO-2026-006' => ['item_id' => 'ITEM-106', 'quantity_ordered' => 100, 'unit_price' => 5.00],
            'PO-2026-007' => ['item_id' => 'ITEM-107', 'quantity_ordered' => 5, 'unit_price' => 500.00],
            'PO-2026-008' => ['item_id' => 'ITEM-108', 'quantity_ordered' => 30, 'unit_price' => 12.00],
            'PO-2026-009' => ['item_id' => 'ITEM-109', 'quantity_ordered' => 8, 'unit_price' => 200.00],
            'PO-2026-010' => ['item_id' => 'ITEM-110', 'quantity_ordered' => 12, 'unit_price' => 80.00],
        ];

        $records = $dbReceipts->map(function ($row) use ($poMap) {
            $poInfo = $poMap[$row->po_number] ?? ['item_id' => 'ITEM-UNK', 'quantity_ordered' => 0, 'unit_price' => 0.00];
            $tickets = explode(' / ', $row->delivery_ticket);

            return [
                'id' => $row->id,
                'po_number' => $row->po_number,
                'po_status' => 'Checked',
                'item_id' => $poInfo['item_id'],
                'quantity_ordered' => $poInfo['quantity_ordered'],
                'unit_price' => (float)$poInfo['unit_price'],
                'po_total' => $poInfo['quantity_ordered'] * $poInfo['unit_price'],

                'receipt_number' => $tickets[0] ?? 'GR-000',
                'quantity_received' => $row->qty_received,
                'date_received' => $row->receiving_date,

                'invoice_number' => $tickets[1] ?? 'INV-000',
                'total_amount_billed' => (float)$row->invoice_val,
                'due_date' => date('Y-m-d', strtotime($row->receiving_date . ' + 30 days')),

                'approval_status' => $row->status == 'Approved' ? 'Approved' : 'Pending',
            ];
        });

        return view('malacaste', compact('records'));
    }

    public function apiVerify($id)
    {
        $receipt = Receipt::findOrFail($id);
        $receipt->status = 'Approved';
        $receipt->save();

        return response()->json(['success' => true]);
    }
}