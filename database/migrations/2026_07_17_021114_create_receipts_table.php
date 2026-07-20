<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('receipts', function (Blueprint $table) {
            $table->id();
            $table->string('po_number');
            $table->string('supplier_name');
            $table->string('delivery_ticket');
            $table->date('receiving_date');
            $table->string('item_desc');
            $table->integer('qty_received');
            $table->decimal('invoice_val', 15, 2);
            $table->boolean('check_price')->default(false);
            $table->boolean('check_delivery')->default(false);
            $table->boolean('check_payment')->default(false);
            $table->string('status')->default('Pending Verification');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('receipts');
    }
};