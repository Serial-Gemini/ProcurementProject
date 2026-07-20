<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('requisitions', function (Blueprint $table) {
            // Only add the column if it doesn't already exist
            if (!Schema::hasColumn('requisitions', 'manager_note')) {
                $table->text('manager_note')->nullable()->after('status');
            }
        });
    }

    public function down()
    {
        Schema::table('requisitions', function (Blueprint $table) {
            $table->dropColumn('manager_note');
        });
    }
};
