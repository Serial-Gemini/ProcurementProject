<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('requisitions', function (Blueprint $table) {
        $table->string('status')->default('Pending')->after('comments');
        $table->text('manager_note')->nullable()->after('status');
    });
}

public function down()
{
    Schema::table('requisitions', function (Blueprint $table) {
        $table->dropColumn(['status', 'manager_note']);
    });
}
};
