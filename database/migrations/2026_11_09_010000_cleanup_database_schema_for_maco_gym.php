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
        // 1. Sesuaikan kolom pada tabel members
        Schema::table('members', function (Blueprint $table) {
            if (! Schema::hasColumn('members', 'birth_date')) {
                $table->date('birth_date')->nullable()->after('gender');
            }
            if (! Schema::hasColumn('members', 'package_name')) {
                $table->string('package_name')->nullable()->after('status');
            }

            $columnsToDrop = [];
            if (Schema::hasColumn('members', 'branch')) {
                $columnsToDrop[] = 'branch';
            }
            if (Schema::hasColumn('members', 'target_weight_kg')) {
                $columnsToDrop[] = 'target_weight_kg';
            }
            if (Schema::hasColumn('members', 'fitness_goal')) {
                $columnsToDrop[] = 'fitness_goal';
            }

            if (! empty($columnsToDrop)) {
                $table->dropColumn($columnsToDrop);
            }
        });

        // 2. Hapus tabel-tabel yang tidak digunakan (dead tables)
        Schema::dropIfExists('member_routines');
        Schema::dropIfExists('member_progress');
        Schema::dropIfExists('trainers');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // 1. Recreate tabel trainers
        if (! Schema::hasTable('trainers')) {
            Schema::create('trainers', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('specialty');
                $table->string('phone')->nullable();
                $table->string('photo_path')->nullable();
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        // 2. Recreate tabel member_progress
        if (! Schema::hasTable('member_progress')) {
            Schema::create('member_progress', function (Blueprint $table) {
                $table->id();
                $table->foreignId('member_id')->constrained()->cascadeOnDelete();
                $table->decimal('weight_kg', 5, 2);
                $table->decimal('height_cm', 5, 2);
                $table->decimal('waist_cm', 5, 2)->nullable();
                $table->decimal('chest_cm', 5, 2)->nullable();
                $table->text('notes')->nullable();
                $table->date('recorded_at');
                $table->timestamps();
            });
        }

        // 3. Recreate tabel member_routines
        if (! Schema::hasTable('member_routines')) {
            Schema::create('member_routines', function (Blueprint $table) {
                $table->id();
                $table->foreignId('member_id')->constrained()->cascadeOnDelete();
                $table->string('day_name');
                $table->string('title');
                $table->json('target_exercises');
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        // 4. Kembalikan kolom di tabel members
        Schema::table('members', function (Blueprint $table) {
            if (Schema::hasColumn('members', 'birth_date')) {
                $table->dropColumn('birth_date');
            }
            if (! Schema::hasColumn('members', 'branch')) {
                $table->string('branch')->default('Pandanwangi')->after('gender');
            }
            if (! Schema::hasColumn('members', 'target_weight_kg')) {
                $table->decimal('target_weight_kg', 5, 2)->nullable()->after('branch');
            }
            if (! Schema::hasColumn('members', 'fitness_goal')) {
                $table->string('fitness_goal')->nullable()->after('target_weight_kg');
            }
        });
    }
};
