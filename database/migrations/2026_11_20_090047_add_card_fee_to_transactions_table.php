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
        Schema::table('transactions', function (Blueprint $table) {
            if (! Schema::hasColumn('transactions', 'package_price')) {
                $table->decimal('package_price', 12, 2)->nullable()->after('amount');
            }
            if (! Schema::hasColumn('transactions', 'card_fee')) {
                $table->decimal('card_fee', 12, 2)->default(0)->after('package_price');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $columns = [];
            if (Schema::hasColumn('transactions', 'card_fee')) {
                $columns[] = 'card_fee';
            }
            if (Schema::hasColumn('transactions', 'package_price')) {
                $columns[] = 'package_price';
            }
            if (! empty($columns)) {
                $table->dropColumn($columns);
            }
        });
    }
};
