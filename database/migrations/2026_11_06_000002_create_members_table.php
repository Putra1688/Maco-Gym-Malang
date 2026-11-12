<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('card_id')->unique();
            $table->string('name');
            $table->string('phone');
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->date('join_date');
            $table->date('current_expiry_date');
            $table->enum('status', ['active', 'expired', 'pending_verification'])->default('pending_verification');
            $table->string('package_name')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
