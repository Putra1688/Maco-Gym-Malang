<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->string('branch')->default('Pandanwangi')->after('gender');
            $table->decimal('target_weight_kg', 5, 2)->nullable()->after('branch');
            $table->string('fitness_goal')->nullable()->after('target_weight_kg');
        });

        Schema::table('member_progress', function (Blueprint $table) {
            $table->decimal('waist_cm', 5, 2)->nullable()->after('height_cm');
            $table->decimal('chest_cm', 5, 2)->nullable()->after('waist_cm');
            $table->text('notes')->nullable()->after('chest_cm');
        });
    }

    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->dropColumn(['branch', 'target_weight_kg', 'fitness_goal']);
        });

        Schema::table('member_progress', function (Blueprint $table) {
            $table->dropColumn(['waist_cm', 'chest_cm', 'notes']);
        });
    }
};
