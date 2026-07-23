<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('vendor_invoices', function (Blueprint $table) {
        $table->id();
        $table->string('invoice_number');
        $table->string('po_number');
        $table->decimal('total_amount_billed', 8, 2);
        $table->date('due_date');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_invoices');
    }
};
