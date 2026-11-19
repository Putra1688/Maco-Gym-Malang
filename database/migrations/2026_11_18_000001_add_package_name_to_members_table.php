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
        Schema::table('members', function (Blueprint $table) {
            if (! Schema::hasColumn('members', 'package_name')) {
                $table->string('package_name')->nullable()->after('status');
            }
        });

        if (Schema::hasColumn('users', 'role')) {
            DB::table('users')->where('role', 'staff')->update(['role' => 'admin']);
            DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'member') NOT NULL DEFAULT 'member'");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
            if (Schema::hasColumn('members', 'package_name')) {
                $table->dropColumn('package_name');
            }
        });
    }
};
