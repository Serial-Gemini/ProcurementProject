<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PurchaseOrder;
use App\Models\GoodsReceipt;
use App\Models\VendorInvoice;

class MatchingSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing records to avoid duplicates
        PurchaseOrder::truncate();
        GoodsReceipt::truncate();
        VendorInvoice::truncate();

        $purchaseOrders = [
            ['po_number' => 'PO-2026-001', 'item_id' => 'ITEM-101', 'quantity_ordered' => 20, 'unit_price' => 150.00],
            ['po_number' => 'PO-2026-002', 'item_id' => 'ITEM-102', 'quantity_ordered' => 15, 'unit_price' => 300.00],
            ['po_number' => 'PO-2026-003', 'item_id' => 'ITEM-103', 'quantity_ordered' => 50, 'unit_price' => 25.00],
            ['po_number' => 'PO-2026-004', 'item_id' => 'ITEM-104', 'quantity_ordered' => 10, 'unit_price' => 120.00],
            ['po_number' => 'PO-2026-005', 'item_id' => 'ITEM-105', 'quantity_ordered' => 40, 'unit_price' => 15.00],
            ['po_number' => 'PO-2026-006', 'item_id' => 'ITEM-106', 'quantity_ordered' => 100, 'unit_price' => 5.00],
            ['po_number' => 'PO-2026-007', 'item_id' => 'ITEM-107', 'quantity_ordered' => 5, 'unit_price' => 500.00],
            ['po_number' => 'PO-2026-008', 'item_id' => 'ITEM-108', 'quantity_ordered' => 30, 'unit_price' => 12.00],
            ['po_number' => 'PO-2026-009', 'item_id' => 'ITEM-109', 'quantity_ordered' => 8, 'unit_price' => 200.00],
            ['po_number' => 'PO-2026-010', 'item_id' => 'ITEM-110', 'quantity_ordered' => 12, 'unit_price' => 80.00],
        ];

        $goodsReceipts = [
            ['receipt_number' => 'GR-901', 'po_number' => 'PO-2026-001', 'quantity_received' => 20, 'date_received' => '2026-07-01'],
            ['receipt_number' => 'GR-902', 'po_number' => 'PO-2026-002', 'quantity_received' => 10, 'date_received' => '2026-07-03'],
            ['receipt_number' => 'GR-903', 'po_number' => 'PO-2026-003', 'quantity_received' => 50, 'date_received' => '2026-07-05'],
            ['receipt_number' => 'GR-904', 'po_number' => 'PO-2026-004', 'quantity_received' => 10, 'date_received' => '2026-07-08'],
            ['receipt_number' => 'GR-905', 'po_number' => 'PO-2026-005', 'quantity_received' => 40, 'date_received' => '2026-07-10'],
            ['receipt_number' => 'GR-906', 'po_number' => 'PO-2026-006', 'quantity_received' => 100, 'date_received' => '2026-07-12'],
            ['receipt_number' => 'GR-907', 'po_number' => 'PO-2026-007', 'quantity_received' => 3, 'date_received' => '2026-07-15'],
            ['receipt_number' => 'GR-908', 'po_number' => 'PO-2026-008', 'quantity_received' => 30, 'date_received' => '2026-07-16'],
            ['receipt_number' => 'GR-909', 'po_number' => 'PO-2026-009', 'quantity_received' => 8, 'date_received' => '2026-07-18'],
            ['receipt_number' => 'GR-910', 'po_number' => 'PO-2026-010', 'quantity_received' => 12, 'date_received' => '2026-07-20'],
        ];

        $vendorInvoices = [
            ['invoice_number' => 'INV-701', 'po_number' => 'PO-2026-001', 'total_amount_billed' => 3000.00, 'due_date' => '2026-08-01'],
            ['invoice_number' => 'INV-702', 'po_number' => 'PO-2026-002', 'total_amount_billed' => 4500.00, 'due_date' => '2026-08-03'],
            ['invoice_number' => 'INV-703', 'po_number' => 'PO-2026-003', 'total_amount_billed' => 1250.00, 'due_date' => '2026-08-05'],
            ['invoice_number' => 'INV-704', 'po_number' => 'PO-2026-004', 'total_amount_billed' => 1500.00, 'due_date' => '2026-08-08'],
            ['invoice_number' => 'INV-705', 'po_number' => 'PO-2026-005', 'total_amount_billed' => 600.00, 'due_date' => '2026-08-10'],
            ['invoice_number' => 'INV-706', 'po_number' => 'PO-2026-006', 'total_amount_billed' => 500.00, 'due_date' => '2026-08-12'],
            ['invoice_number' => 'INV-707', 'po_number' => 'PO-2026-007', 'total_amount_billed' => 2500.00, 'due_date' => '2026-08-15'],
            ['invoice_number' => 'INV-708', 'po_number' => 'PO-2026-008', 'total_amount_billed' => 360.00, 'due_date' => '2026-08-16'],
            ['invoice_number' => 'INV-709', 'po_number' => 'PO-2026-009', 'total_amount_billed' => 1800.00, 'due_date' => '2026-08-18'],
            ['invoice_number' => 'INV-710', 'po_number' => 'PO-2026-010', 'total_amount_billed' => 960.00, 'due_date' => '2026-08-20'],
        ];

        foreach ($purchaseOrders as $po) PurchaseOrder::create($po);
        foreach ($goodsReceipts as $gr) GoodsReceipt::create($gr);
        foreach ($vendorInvoices as $inv) VendorInvoice::create($inv);
    }
}